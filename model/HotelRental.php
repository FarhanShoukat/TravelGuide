<?php
require_once "DBHelper.php";

class HotelRental {
    public static function getRentalsOfHotel($hotel) {
        $sql = "SELECT Title, Description, Rental AS Price FROM HotelRental WHERE Hotel = ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array($hotel));
    }

    public static function addNewRental($hotel, $title, $desc, $rental) {
        $sql = "INSERT INTO `hotelrental`(`Hotel`, `Title`, `Description`, `Rental`) VALUES (?, ?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "sssi", array($hotel, $title, $desc, $rental));
    }
}