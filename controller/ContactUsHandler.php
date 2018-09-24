<?php
require_once "../model/ContactUs.php";

$name = $_REQUEST["name"];
$phone = $_REQUEST["phone"];
$email = $_REQUEST["email"];
$message = $_REQUEST["message"];

ContactUs::submitContactUs($name, $phone, $email, $message);
header("Location: ../view/home.php");