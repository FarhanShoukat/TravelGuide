<?php
require_once "DBHelper.php";

class Attraction
{
    public static function getAttractionsWRTNameAndDestination($subString) {
        $sql = "SELECT CONCAT(Name, ', ', Destination) AS Search FROM attraction WHERE CONCAT(Name, ', ', Destination) LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array("%" . $subString . "%"));
    }

    public static function getAttractionsOfDestination($dest, $subString) {
        $sql = "SELECT CONCAT(Name, ', ', Destination) AS Search FROM attraction WHERE Destination = ? AND CONCAT(Name, ', ', Destination) LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "ss", array($dest, "%" . $subString . "%"));
    }
}