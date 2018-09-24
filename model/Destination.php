<?php require_once "DBHelper.php";

class Destination {
    public static function getDestinations($subString) {
        $sql = "SELECT * FROM destination WHERE NAME LIKE ?";
        return DBHelper::executeResultSQLPrepared($sql, "s", array("%" . $subString . "%"));
    }

    public static function getDestinationsNameOrdered($subString) {
        $sql = "SELECT * FROM destination WHERE Name LIKE ? ORDER BY Name";
        return DBHelper::executeResultSQLPrepared($sql, "s", array("%" . $subString . "%"));
    }
}