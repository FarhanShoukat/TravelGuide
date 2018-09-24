<?php
require_once "DBHelper.php";

class ContactUs {
    public static function submitContactUs($name, $phone, $email, $message) {
        $sql = "INSERT INTO `ContactUs`(`Name`, `Phone`, `Email`, `Message`) VALUES (?, ?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ssss", array($name, $phone, $email, $message));
    }
}