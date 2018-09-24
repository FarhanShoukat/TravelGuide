<?php

function validateName($id) {
    $name = $_REQUEST[$id];
    if(strlen($name) < 3) return array(false, "Name should have at least 3 letters.");

    if(preg_match('/[^A-Za-z]/', $name)) return array(false, "Name can only have letters.");

    return array(true, "");
}

function validateEmail($id) {
    $email = $_REQUEST[$id];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return array(false, "Email is invalid.");

    return array(true, "");
}

function validatePassword($id) {
    $pass = $_REQUEST[$id];
    if(strlen($pass) < 6) return array(false, "Password is too short (At least 6 length)");

    if($pass === strtolower($pass)) return array(false, "Password should have at least 1 upper case letter.");

    if(!preg_match('/\\d/', $pass)) return array(false, "Password should have at least 1 number.");

    return array(true, "");
}