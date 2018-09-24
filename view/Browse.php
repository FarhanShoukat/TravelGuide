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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/images/mnjkkzzqifopytpboocv-499x498.png" type="image/x-icon">
    <meta name="description" content="Website Creator Description">
    <title>Browse - TravelGuide</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    <link rel="stylesheet" href="SearchWidget.css">

    <script src="SearchWidget.js"></script>

</head>
<body>
<?php include 'navbar.php';?>

<br/>
<div id="search">
    <section class='cid-qLeTwvv03o'>
        <div class='container'>
            <div class='form-control' id='ext1'>
                <div class='row' id="search-d1">
                    <div class='col-md-12'>
                        <input type='text' class='form-control input' name='search-d1' data-form-field='SearchSource' placeholder='Select Source' id="search-d-s1" onkeyup="sourceDataChage()" style='margin-bottom: 0; border-left: white; border-right: white; border-top: white;'>
                    </div>
                </div>
                <div class='list-d' id="list-d1"></div>
            </div>

            <br/>
            <div class='form-control' id='ext'>
                <div class='row' id="search-d">
                    <div class='col-md-12'>
                        <input type='text' class='form-control input' name='search-d' data-form-field='SearchDestination' placeholder='Search Destination, Attraction, Hotel, Restaurant' id="search-d-s" onkeyup='destDataChange()' style='margin-bottom: 0; border-left: white; border-right: white; border-top: white;'>
                    </div>
                </div>
                <div class='list-d' id="list-d"></div>
            </div>

            <div id="search_secondary" style='display: none'>
                <div class='row' id="search-hra">
                    <div class=' col-md-12'>
                        <input type='text' class='form-control input' name='search-hra' data-form-field='SearchHRA' placeholder="Search" id="search-hra-s" onkeyup='updateSecondaryResults()'>
                    </div>
                </div>
                <div class='row' id="filters">
                    <div class='col-md-3'>
                        <br/>
                        <p class='form-control-label mbr-fonts-style display-7'>Type:</p>
                        <select title="Type Filter" class='d-inline form-control' id="type-filter" onchange='typeChanged()'>
                            <option class='form-control'>Attractions</option>
                            <option class='form-control'>Hotels</option>
                            <option class='form-control'>Restaurants</option>
                            <option class='form-control'>Travel info(By Air)</option>
                            <option class='form-control'>Travel info(By Road)</option>
                        </select>
                    </div>
                    <div class='col-md-3' id="order" style="display: none">
                        <br/>
                        <p class='form-control-label mbr-fonts-style display-7'>Order By:</p>
                        <select title="Order By" class='d-inline form-control' id="order-by" onchange='updateSecondaryResults()'>
                            <option class='form-control'>Name</option>
                            <option class='form-control'>Rating</option>
                        </select>
                    </div>
                    <div class='col-md-6' id="price" style='display: none'>
                        <br/>
                        <p class='form-control-label mbr-fonts-style display-7'>Price:</p>
                        <input type='text' class='form-control d-inline' id="t-min" placeholder="Min" onkeyup='updateSecondaryResults()'/>
                        -
                        <input type='text' class='form-control d-inline' id="t-max" placeholder="Max" onkeyup='updateSecondaryResults()'/>
                    </div>
                </div>
            </div>

            <br/>
            <div id="sec-search-results"></div>
        </div>
    </section>
</div>

<section class="engine"><a href="https://mobirise.ws/e">best website maker software</a></section><script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/theme/js/script.js"></script>
  
  
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
</body>
</html>