<?php require 'validation.php'; ?>
<?php require "../model/User.php"; ?>
<?php session_start(); ?>

<?php
    if ($_REQUEST["action"] == "register") registerHandler();
	else if ($_REQUEST["action"] == "login") loginHandler();
	else if ($_REQUEST["action"] == "loginFB") loginWithFacebookHandler();
	else if($_REQUEST["action"] == "logout") logoutHandler();
?>

<?php
function registerHandler() {
    $firstID = 'first-name';
    $secondID = 'second-name';
    $emailID = 'email';
    $passID = 'password';
    $confID = 'confirm-password';

    $first = $_REQUEST[$firstID];
    $second = $_REQUEST[$secondID];
    $email = $_REQUEST[$emailID];
    $pass = $_REQUEST[$passID];
    $conf = $_REQUEST[$confID];

    $test1 = validateName($firstID);
    $test2 = validateName($secondID);
    $test3 = validateEmail($emailID);
    $test4 = validatePassword($passID);
    $test5 = !User::userExists($email);

    if($test1[0] && $test2[0] && $test3[0] && $test4[0] && $pass == $conf && $test5) {
        $name = $first . ' ' . $second;
        User::createUser($name, $email, $pass);
        $_SESSION["user"] = new User($email);
        header("Location: ../view/home.php?user=new");
    }
    else {
        $errorMessage = "";
        if(!$test1[0])
            $errorMessage = $test1[1];
        else if(!$test2[0])
            $errorMessage = $test2[1];
        else if(!$test3[0])
            $errorMessage = $test3[1];
        else if(!$test4[0])
            $errorMessage = $test4[1];
        else if($pass != $conf)
            $errorMessage = "Password and Confirm Password do not match.";
        else if(!$test5[0])
            $errorMessage = "User with this email already exists.";
        header("Location: ../view/RegisterSignIn.php?errortype=register&error=" . $errorMessage . "&first=" . $first . "&second=" . $second . "&email=" . $email);
    }
}

function loginHandler() {
    $emailID = 'email';
    $passID = 'password';

    $email = $_REQUEST[$emailID];
    $pass = $_REQUEST[$passID];

    $test1 = validateEmail($emailID);
    $test2 = validatePassword($passID);
    $test3 = User::validate($email, $pass);
    if($test1[0] && $test2[0] && $test3[0]) {
        $_SESSION["user"] = new User($email);
        header("Location: ../view/home.php");
    }
    else {
        $errorMessage = "";
    	if(!$test1[0])
    	    $errorMessage = $test1[1];
    	else if(!$test2[0])
            $errorMessage = $test2[1];
    	else if(!$test3[0])
            $errorMessage = $test3[1];
        header("Location: ../view/RegisterSignIn.php?errortype=login&error=" . $errorMessage . "&email=" . $email);
    }


}

function loginWithFacebookHandler() {
    $id = $_REQUEST["id"];
    $name = $_REQUEST["name"];
    if(!User::userExists($id)) {
        User::createUserFB($name, $id);
    }
    $_SESSION["user"] = new User($id);
    header("Location: ../view/home.php");
}

function logoutHandler(){
    $_SESSION["user"] = null;
	unset($_SESSION["user"]);
    header("Location: ../view/home.php");
}
?>