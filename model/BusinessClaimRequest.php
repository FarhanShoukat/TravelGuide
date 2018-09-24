<?php
/**
 * Created by PhpStorm.
 * User: Farhan
 * Date: 15-Apr-18
 * Time: 4:54 PM
 */

class BusinessClaimRequest
{
    public static function addMusinessClaimRequest($user, $business) {
        $sql = "INSERT INTO BusinessClaimRequest(User, Business) VALUES (?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ss", array($user, $business));
    }
}