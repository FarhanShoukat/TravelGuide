<?php
require_once("../model/User.php");
session_start();
$user = null;
if(array_key_exists("user", $_SESSION))
    header("Location: home.php");

$eType = 0;
if(array_key_exists("errortype", $_REQUEST)) {
    if ($_REQUEST["errortype"] == "login") $eType = 1;
    else $eType = 2;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.6.5, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mnjkkzzqifopytpboocv-499x498.png" type="image/x-icon">
    <meta name="description" content="Site Generator Description">
    <title>Register | SignIn - TravelGuide</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    <script type="text/javascript" src="assets/javascript/Validation.js"></script>

    <script>
        function compare(first, second) {
            let pass = document.getElementById(first).value;
            let conf = document.getElementById(second);
            if(pass === conf.value) return true;

            conf.setCustomValidity('Does not match with password.');
            return false;
        }
        function validateRegister() {
            let valid = validateName('first-name-form4-b');
            valid = validateName('second-name-form4-b') && valid;
            valid = validatePassword('password-form4-b') && valid;
            valid = compare('password-form4-b', 'confirm-password-form4-b') && valid;

            return valid
        }
    </script>

    <style>
        .alert-danger { background-color: #FFCDD2; }
        .myalert { color: #B71C1C; }
    </style>
</head>
<body>
<div id="fb-root"></div>
<?php require_once "Facebook.php"; ?>
<script>
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }
</script>

<?php include 'navbar.php';?>

<section class="mbr-section form4 cid-qLeTwvv03o" id="form4-b">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="pb-3 align-left mbr-fonts-style display-2">Log In</h2>
                <?php
                if($eType == 1)
                    echo "<div class=\"alert alert-form alert-danger text-xs-center\" id=\"login-alert\"><span class=\"myalert font-weight-bold\">" . $_REQUEST["error"] . "</span></div>";
                ?>
                <form class="block mbr-form" action="../controller/LoginRegisterHandler.php?action=login" method="post">
                    <div class="col-md-12" data-for="email">
                        <input type="email" class="form-control input" name="email" data-form-field="Email" placeholder="Email" required id="email-form4-a"
                            <?php
                            if($eType == 1)
                                echo " value=" . "'" . $_REQUEST["email"] . "'";
                            ?>
                        >
                    </div>

                    <div class="col-md-12" data-for="password">
                        <input type="password" class="form-control input" name="password" data-form-field="Password" placeholder="Password" required id="password-form4-a" onkeypress="this.setCustomValidity('')" onblur="validatePassword('password-form4-a')">
                    </div>

                    <div class="input-group-btn col-md-12" style="margin-top: 10px;"><button href="" type="submit" class="btn btn-primary btn-form display-4" onclick="return validatePassword('password-form4-a')">LOG IN</button></div>
                </form>
                <div class="input-group-btn col-md-12" style="margin-top: 10px">
                    <p>Or</p>
                    <div scope="public_profile,user_friends" onlogin="checkLoginState();" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="pb-3 align-left mbr-fonts-style display-2">Register</h2>
                <?php
                if($eType == 2)
                    echo "<div class=\"alert alert-form alert-danger text-xs-center\"><span class=\"myalert font-weight-bold\">" . $_REQUEST["error"] . "</span></div>";
                ?>
                <form class="block mbr-form" action="../controller/LoginRegisterHandler.php?action=register" method="post">
                    <div class="row">
                        <div class="col-md-6 multi-horizontal" data-for="first-name">
                            <input type="text" class="form-control input" name="first-name" autocomplete='given-name' data-form-field="FirstName" placeholder="First Name" required id="first-name-form4-b" onkeypress="this.setCustomValidity('')" onblur="validateName('first-name-form4-b')"
                                <?php
                                if($eType == 2)
                                    echo " value=" . "'" . $_REQUEST["first"] . "'";
                                ?>
                            >
                        </div>

                        <div class="col-md-6 multi-horizontal" data-for="second-name">
                            <input type="text" class="form-control input" name="second-name" autocomplete='family-name' data-form-field="SecondName" placeholder="Second Name" required id="second-name-form4-b" onkeypress="this.setCustomValidity('')" onblur="validateName('second-name-form4-b')"
                                <?php
                                if($eType == 2)
                                    echo " value=" . "'" . $_REQUEST["second"] . "'";
                                ?>
                            >
                        </div>

                        <div class="col-md-12" data-for="email">
                            <input type="email" class="form-control input" name="email" data-form-field="Email" placeholder="Email" required id="email-form4-b"
                                <?php
                                if($eType == 2)
                                    echo " value=" . "'" . $_REQUEST["email"] . "'";
                                ?>
                            >
                        </div>

                        <div class="col-md-12" data-for="password">
                            <input type="password" class="form-control input" name="password" data-form-field="Password" placeholder="Password" id="password-form4-b" onkeypress="this.setCustomValidity('')" onblur="validatePassword('password-form4-b')">
                        </div>

                        <div class="col-md-12" data-for="confirm-password">
                            <input type="password" class="form-control input" name="confirm-password" autocomplete="current-password" data-form-field="ConfirmPassword" placeholder="Confirm Password" required id="confirm-password-form4-b" onkeypress="this.setCustomValidity('')" onblur="compare('password-form4-b', 'confirm-password-form4-b')">
                        </div>

                        <div class="input-group-btn col-md-12" style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-form display-4" onclick="return validateRegister()">REGISTER</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php';?>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>


<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
</body>
</html>