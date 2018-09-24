<?php
require_once "DBHelper.php";

class RestaurantDeal {
    public static function getDealsOfRestaurant($restaurant) {
        $sql = "SELECT Title, Description, Price FROM RestaurantDeal WHERE Restaurant= ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array($restaurant));
    }

    public static function addNewDeal($restaurant, $title, $desc, $price) {
        $sql = "INSERT INTO `restaurantdeal`(`Restaurant`, `Title`, `Description`, `Price`) VALUES (?, ?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "sssi", array($restaurant, $title, $desc, $price));
    }
}