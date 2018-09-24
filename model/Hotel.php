<?php
require_once "DBHelper.php";

class Hotel
{
    private $title = null;
    private $description = null;
    private $address = null;
    private $phone = null;
    private $website = null;

    public function __construct($title){
        $sql = "SELECT Title, Description, Address, Phone, Website FROM hotel WHERE Title = ?";
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

    public static function getHotelsWRTNameAndDestination($subString) {
        $sql = "SELECT Title, Destination FROM hotel WHERE CONCAT(Title, ', ', Destination) LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array("%" . $subString . "%"));
    }

    public static function getHotelsOfDestination($destination) {
        $sql = "SELECT Title, Destination, Address, Phone, Website FROM hotel WHERE Destination = ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array($destination));
    }

    public static function getHotelsOfDestinationNameOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? GROUP BY F.Title ORDER BY F.Title";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getHotelsOfDestinationNameOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? AND COALESCE(HR.Rental, 0) <= ? GROUP BY F.Title ORDER BY F.Title";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function getHotelsOfDestinationRatingOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? GROUP BY F.Title ORDER BY AVG(F.Rating) DESC";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getHotelsOfDestinationRatingOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? AND COALESCE(HR.Rental, 0) <= ? GROUP BY F.Title ORDER BY AVG(F.Rating) DESC";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function getHotelsOfDestinationPriceOrdered($dest, $subString, $min) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? GROUP BY F.Title ORDER BY MIN(HR.Rental) IS NULL, MIN(HR.Rental)";
        return DBHelper::executeResultSQLPrepared($sql, "ssi", array($dest, "%" . $subString . "%", $min));
    }

    public static function getHotelsOfDestinationPriceOrderedMax($dest, $subString, $min, $max) {
        $sql = "SELECT F.Title, AVG(F.Rating) Rating, MIN(HR.Rental) `Min`, MAX(HR.Rental) `Max` FROM (SELECT H.Title, COALESCE(R.Rating, 0) AS Rating FROM Hotel AS H LEFT JOIN Rating AS R ON H.Title=R.Facility WHERE H.Destination = ? AND CONCAT(H.Title, ', ', H.Destination) LIKE ?) AS F LEFT JOIN HotelRental AS HR ON F.Title=HR.Hotel WHERE COALESCE(HR.Rental, 0) >= ? AND COALESCE(HR.Rental, 0) <= ? GROUP BY F.Title ORDER BY MIN(HR.Rental) IS NULL, MIN(HR.Rental)";
        return DBHelper::executeResultSQLPrepared($sql, "ssii", array($dest, "%" . $subString . "%", $min, $max));
    }

    public static function hotelExists($title) {
        $sql = "SELECT * FROM hotel WHERE Title = ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "s", array($title));
        return sizeof($rs) > 0;
    }

    public static function createHotel($title, $description, $address, $phone, $website, $destination) {
        $sql = "INSERT INTO hotel(Title, Description, Address, Phone, Website, Destination) VALUES (?, ?, ?, ?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ssssss", array($title, $description, $address, $phone, $website, $destination));
    }
}