<?php

$DATABASE_NAME = 'projectdatabase';

class DBHelper
{
    public static function executeNonResultSQL($sql) {
        $conn = DBHelper::getMysqliConnection();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    public static function executeNonResultSQLPrepared($sql, $types = null, $params = null) {
        $conn = DBHelper::getMysqliConnection();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public static function executeResultSQL($sql)  {
        $conn = DBHelper::getMysqliConnection();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query($sql);
        $rs = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($rs, $row);
            }
        }
        $conn->close();
        return $rs;
    }

    public static function executeResultSQLPrepared($sql, $types = null, $params = null) {
        $conn = DBHelper::getMysqliConnection();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        $stmt->execute();
        $result = $stmt->get_result();

        $rs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($rs, $row);
            }
        }

        $stmt->close();
        $conn->close();

        return $rs;
    }

    public static function executeResultSQLPreparedForReviews($sql, $types = null, $title, $type, $friends) {
        $conn = DBHelper::getMysqliConnection();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, $title, $type, ...$friends);

        $stmt->execute();
        $result = $stmt->get_result();

        $rs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($rs, $row);
            }
        }

        $stmt->close();
        $conn->close();

        return $rs;
    }

    private static function getMySqliConnection() {
        global $DATABASE_NAME;
        return new mysqli("localhost:3306", "root","", $DATABASE_NAME);
    }
}