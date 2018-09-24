<?php
require_once("../model/User.php");
session_start();
$user = null;
if(array_key_exists("user", $_SESSION))
    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.6.5, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mnjkkzzqifopytpboocv-499x498.png" type="image/x-icon">
    <meta name="description" content="Website Maker Description">
    <title>Contact Us - TravelGuide</title>
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

    <style>
        em.em{ color: red; }
    </style>
  
</head>
<body>
<?php include 'navbar.php';?>

<section class="mbr-section form1 cid-qLurDPj91a" id="form1-z">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    CONTACT FORM
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8">
                <form class="mbr-form" action="../controller/ContactUsHandler.php" method="post">
                    <div class="row row-sm-offset">
                        <div class="col-md-6 multi-horizontal" data-for="name">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="name-form1-z">Name</label>
                                <input type="text" maxlength="100" class="form-control" name="name" data-form-field="Name" required id="name-form1-z">
                            </div>
                        </div>
                        <div class="col-md-6 multi-horizontal" data-for="phone">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-z">Phone</label>
                                <input type="number" class="form-control" name="phone" data-form-field="Phone" id="phone-form1-z" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label mbr-fonts-style display-7" for="address-form1-z">Email</label>
                        <input type="email" maxlength="50" class="form-control" name="email" data-form-field="Address" required id="address-form1-z">
                    </div>
                    <div class="form-group" data-for="message">
                        <label class="form-control-label mbr-fonts-style display-7" for="message-form1-z">Message</label>
                        <textarea type="text" maxlength="1000" class="form-control" name="message" rows="7" data-form-field="Message" id="message-form1-z" required></textarea>
                    </div>
                    <span class="input-group-btn">
                            <button href="" type="submit" class="btn btn-primary btn-form display-4">SUBMIT</button>
                        </span>
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