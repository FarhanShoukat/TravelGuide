<?php
require_once "DBHelper.php";

class TravelInformation {
    public static function getTravelInformationOfSourceToDestinationCompanyOrdered($source, $destination, $type, $subString, $min) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? ORDER BY TravelCompany";
        return DBHelper::executeResultSQLPrepared($sql, "isssi", array($type, "%" . $subString . "%", $source, $destination, $min));
    }

    public static function getTravelInformationOfSourceToDestinationCompanyOrderedMax($source, $destination, $type, $subString, $min, $max) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? AND Price <= ? ORDER BY TravelCompany";
        return DBHelper::executeResultSQLPrepared($sql, "isssii", array($type, "%" . $subString . "%", $source, $destination, $min, $max));
    }

    public static function getTravelInformationOfSourceToDestinationPriceOrdered($source, $destination, $type, $subString, $min) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? ORDER BY `Price`";
        return DBHelper::executeResultSQLPrepared($sql, "isssi", array($type, "%" . $subString . "%", $source, $destination, $min));
    }

    public static function getTravelInformationOfSourceToDestinationPriceOrderedMax($source, $destination, $type, $subString, $min, $max) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? AND Price <= ? ORDER BY Price";
        return DBHelper::executeResultSQLPrepared($sql, "isssii", array($type, "%" . $subString . "%", $source, $destination, $min, $max));
    }

    public static function getTravelInformationOfSourceToDestinationDateOrdered($source, $destination, $type, $subString, $min) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? ORDER BY `Date`, `Time`";
        return DBHelper::executeResultSQLPrepared($sql, "isssi", array($type, "%" . $subString . "%", $source, $destination, $min));
    }

    public static function getTravelInformationOfSourceToDestinationDateOrderedMax($source, $destination, $type, $subString, $min, $max) {
        $sql = "SELECT `TravelCompany`, `Date`, `Time`, `Price` FROM TravelInformation WHERE Type = ? AND TravelCompany LIKE ? AND `Source`= ? AND Destination = ? AND Price >= ? AND Price <= ? ORDER BY `Date`, `Time`";
        return DBHelper::executeResultSQLPrepared($sql, "isssii", array($type, "%" . $subString . "%", $source, $destination, $min, $max));
    }
}