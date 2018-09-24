<?php
require_once "DBHelper.php";

class Restaurant
{
    private $title = null;
    private $description = null;
    private $address = null;
    private $phone = null;
    private $website = null;

    public function __construct($title){
        $sql = "SELECT Title, Description, Address, Phone, Website FROM restaurant WHERE Title = ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "s", array($title));
        if(sizeof($rs) > 0) {
            $this->title = $rs[0]["Title"];
            $this->address = $rs[0]["Address"];
            $this->phone = $rs[0]["Phone"];
            $this->description = $rs[0]["Description"];
            $this->website = $rs[0]["Website"];
        }
    }

    public function getTitle() { return $this->title; }

    public function getDescription() { return $this->description; }

    public function getAddress() { return $this->address; }

    public function getPhone() { return $this->phone; }

    public function getWebsite() { return $this->website; }

    public static function getRestaurantsWRTNameAndDestination($subString) {
        $sql = "SELECT Title, Destination FROM Restaurant WHERE CONCAT(Title, ', ', Destination) LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array("%" . $subString . "%"));
    }

    public static function getRestaurantOfDestination($destination) {
        $sql = "SELECT Title, Destination, Address, Phone, Website FROM restaurant WHERE Destination = ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array($destination));
    }

    public static function getRestaurantsOfDestination($dest, $subString) {
        $sql = "SELECT Title, Destination FROM Restaurant WHERE Destination = ? AND CONCAT(Title, ', ', Destination) LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "ss", array($dest, "%" . $subString . "%"));
    }

    public static function getRestaurantsOfDestinationNameOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? GROUP BY F.Title ORDER BY F.Title";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getRestaurantsOfDestinationNameOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? AND COALESCE(HR.Price, 0) <= ? GROUP BY F.Title ORDER BY F.Title";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function getRestaurantsOfDestinationRatingOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? GROUP BY F.Title ORDER BY AVG(F.Rating) DESC";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getRestaurantsOfDestinationRatingOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? AND COALESCE(HR.Price, 0) <= ? GROUP BY F.Title ORDER BY AVG(F.Rating) DESC";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function getRestaurantsOfDestinationPriceOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? GROUP BY F.Title ORDER BY MIN(HR.Price) IS NULL, MIN(HR.Price)";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getRestaurantsOfDestinationPriceOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Price) `Min`, MAX(HR.Price) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Restaurant AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN RestaurantDeal AS HR ON F.Title=HR.Restaurant WHERE COALESCE(HR.Price, 0) >= ? AND COALESCE(HR.Price, 0) <= ? GROUP BY F.Title ORDER BY MIN(HR.Price) IS NULL, MIN(HR.Price)";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function restaurantExists($title) {
        $sql = "SELECT * FROM restaurant WHERE Title = ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "s", array($title));
        return sizeof($rs) > 0;
    }

    public static function createRestaurant($title, $description, $address, $phone, $website, $destination) {
        $sql = "INSERT INTO Restaurant(Title, Description, Address, Phone, Website, Destination) VALUES (?, ?, ?, ?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ssssss", array($title, $description, $address, $phone, $website, $destination));
    }
}