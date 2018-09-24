<?php

require_once("DBHelper.php");

class User {
    private $name = "";
    private $email = "";

    public function __construct($email){
        $this->email = $email;
        $this->load();
    }

    public function getEmail() { return $this->email; }

    public function getName() { return $this->name; }

    private function load() {
        $query = "SELECT Name FROM user WHERE Email= ?";
        $rs = DBHelper::executeResultSQLPrepared($query, "s", array($this->email));

        if (sizeof($rs) > 0) $this->name = $rs[0]["Name"];
    }

    public static function validate($email, $password) {
        $query = "select * from user where Email= ?";
        $rs = DBHelper::executeResultSQLPrepared($query, "s", array($email));

        if (sizeof($rs) > 0){
            if($rs[0]["Password"] == $password){
                return array(true, "");
            }
            return array(false, "Invalid Password.");
        }
        return array(false, "Invalid Email.");
    }

    public static function checkBusinessOwner($email) {
        $sql = "SELECT Business FROM BusinessOwner where User= ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "s", array($email));
        if(sizeof($rs) > 0) {
            $result = array(true);
            $sql = "SELECT Title FROM Hotel where Title= ?";
            if(sizeof(DBHelper::executeResultSQLPrepared($sql, "s", array($rs[0]["Business"]))) > 0) array_push($result, "hotel");
            else array_push($result, "restaurant");
            array_push($result, $rs[0]["Business"]);
            return $result;
        }
        return array(false);
    }

    public static function addBusinessOwner($email, $title) {
        $sql = "INSERT INTO businessowner(User, Business) VALUES (?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ss", array($email, $title));
    }

    public static function checkBusinessClaim($email) {
        $sql = "SELECT Business FROM BusinessClaimRequest where User= ?";
        $rs = DBHelper::executeResultSQLPrepared($sql, "s", array($email));
        if(sizeof($rs) > 0) {
            $result = array(true);
            $sql = "SELECT Title FROM Hotel where Title= ?";
            if(sizeof(DBHelper::executeResultSQLPrepared($sql, "s", array($rs[0]["Business"]))) > 0) array_push($result, "hotel");
            else array_push($result, "restaurant");
            array_push($result, $rs[0]["Business"]);
            return $result;
        }
        return array(false);
    }

    public static function createUser($name, $email, $pass) {
        $sql = "INSERT INTO user(name, email, password) VALUES (?, ?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "sss", array($name, $email, $pass));
    }

    public static function createUserFB($name, $id) {
        $sql = "INSERT INTO user(Name, Email) VALUES (?, ?)";
        DBHelper::executeNonResultSQLPrepared($sql, "ss", array($name, $id));
    }

    public static function userExists($email) {
        $query = "SELECT * FROM user WHERE Email= ?" ;
        $rs = DBHelper::executeResultSQLPrepared($query, "s", array($email));

        if (sizeof($rs) > 0) return true;
        else return false;
    }
}