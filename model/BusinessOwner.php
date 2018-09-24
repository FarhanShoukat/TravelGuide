<?php
require_once "DBHelper.php";

class BusinessOwner {
    public static function checkBusinessOwner($email, $title) {
        $sql = "SELECT * FROM BusinessOwner WHERE User = ? AND Business = ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "ss", array($email, $title));
        return sizeof($rs) > 0;
    }
}