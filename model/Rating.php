<?php
require_once "DBHelper.php";

class Rating
{
    public static function rate($user, $type, $business, $rating, $review) {
        $sql = "REPLACE INTO Rating(User, Facility, FacilityType, Rating, Review) VALUES (\"" . $user . "\", \"" . $business . "\", " . $type . ", " . $rating . ", \"" . $review . "\")";
        DBHelper::executeNonResultSQLPrepared($sql, "ssiis", array($user, $business, $type, $rating, $review));
    }

    public static function getReviewsOfBusiness($title, $type) {
        $sql = "SELECT User.Name AS User, Rating.Rating, Rating.Review FROM Rating INNER JOIN User ON Rating.User=User.Email WHERE Rating.Facility = ? AND Rating.FacilityType = ?";
        return DBHelper::executeResultSQLPrepared($sql, "si", array($title, $type));
    }

    public static function getFriendsReviews($title, $type, $friends) {
        $sql = "SELECT User.Name AS User, Rating.Rating, Rating.Review FROM Rating INNER JOIN User ON Rating.User=User.Email WHERE Rating.Facility = ? AND Rating.FacilityType = ? AND User.Email IN (";
        $a = "si";
        for($i = 0; $i < sizeof($friends); $i++) {
            $sql .= "?,";
            $a .= "s";
        }
        $sql = rtrim($sql,',');
        $sql .= ")";
        return DBHelper::executeResultSQLPreparedForReviews($sql, $a, $title, $type, $friends);
    }

    public static function getNonFriendsReviews($title, $type, $friends) {
        $sql = "SELECT User.Name AS User, Rating.Rating, Rating.Review FROM Rating INNER JOIN User ON Rating.User=User.Email WHERE Rating.Facility = ? AND Rating.FacilityType = ? AND User.Email NOT IN (";
        $a = "si";
        for($i = 0; $i < sizeof($friends); $i++) {
            $sql .= "?,";
            $a .= "s";
        }
        $sql = rtrim($sql,',');
        $sql .= ")";
        return DBHelper::executeResultSQLPreparedForReviews($sql, $a, $title, $type, $friends);
    }
}