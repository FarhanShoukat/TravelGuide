<?php
require_once "../model/User.php";
require_once "../model/BusinessClaimRequest.php";
require_once "../model/Rating.php";
require_once "../model/Hotel.php";
require_once "../model/HotelRental.php";
require_once "../model/Restaurant.php";
require_once "../model/RestaurantDeal.php";
session_start();

if($_REQUEST["action"] == "claim" && array_key_exists("user", $_SESSION)) businessClaim();
else if($_REQUEST["action"] == "rate" && array_key_exists("user", $_SESSION)) rate();
else if($_REQUEST["action"] == "getReviews") getReviews();
else if($_REQUEST["action"] == "getFacebookReviews") getFacebookReviews();
else if($_REQUEST["action"] == "newBusiness" && array_key_exists("user", $_SESSION)) addNewBusiness();
else if($_REQUEST["action"] == "newDealRental" && array_key_exists("user", $_SESSION)) {
    if($_REQUEST["type"] == "hotel") addNewRental();
    else if($_REQUEST["type"] == "restaurant") addNewDeal();
}
else echo "<h1>Invalid Action.</h1>";

function businessClaim() {
    if(array_key_exists("user", $_SESSION)) {
        BusinessClaimRequest::addMusinessClaimRequest($_SESSION["user"]->getEmail(), $_REQUEST["business"]);
        echo '1';
    }
    else echo '0';
}

function rate() {
    $type = 0;
    if($_REQUEST["type"] == "restaurant")
        $type = 1;
    $title = str_replace('"', "'", $_REQUEST["title"]);
    $rating = (int)$_REQUEST["rating"];
    $review = str_replace('"', "'", $_REQUEST["review"]);

    Rating::rate($_SESSION["user"]->getEmail(), $type, $title, $rating, $review);
    echo "1";
}

function getReviews() {
    $type = 0;
    if($_REQUEST["type"] == "restaurant")
        $type = 1;
    $title = $_REQUEST["title"];

    $rs = Rating::getReviewsOfBusiness($title, $type);
    foreach ($rs as $row) {
        echo '<div class="review">';
        echo '<h3>' . $row["User"] . '<span class="mystr">' . $row["Rating"] . '<span class="fa fa-star mystar"></span></span></h3>';
        echo '<p>' . $row["Review"] . '</p>';
        echo '</div>';
    }
}

function getFacebookReviews() {
    $type = 0;
    if($_REQUEST["type"] == "restaurant")
        $type = 1;
    $title = $_REQUEST["title"];
    $friendsCount = $_REQUEST["friendsCount"];
    $friends = array();
    for($i = 0; $i < $friendsCount; $i++) {
        $friends[$i] = $_REQUEST[(string)$i];
    }

    $rs = Rating::getFriendsReviews($title, $type, $friends);
    foreach ($rs as $row) {
        echo '<div class="review">';
        echo '<h3>' . $row["User"] . "(Facebook Friend)" . '<span class="mystr">' . $row["Rating"] . '<span class="fa fa-star mystar"></span></span></h3>';
        echo '<p>' . $row["Review"] . '</p>';
        echo '</div>';
    }

    $rs = Rating::getNonFriendsReviews($title, $type, $friends);
    foreach ($rs as $row) {
        echo '<div class="review">';
        echo '<h3>' . $row["User"] . '<span class="mystr">' . $row["Rating"] . '<span class="fa fa-star mystar"></span></span></h3>';
        echo '<p>' . $row["Review"] . '</p>';
        echo '</div>';
    }
}

function addNewBusiness() {
    if(array_key_exists("user", $_SESSION)) {
        $title = str_replace('"', "'", $_REQUEST["title"]);
        $phone = $_REQUEST['phone'];
        $destination = $_REQUEST['destination'];
        $type = $_REQUEST["businessType"];
        $own = $_REQUEST["own"];
        $address = str_replace('"', "'", $_REQUEST["address"]);
        $website = str_replace('"', "'", $_REQUEST["website"]);
        $description = str_replace('"', "'", $_REQUEST["description"]);

        if ($type == '0') {
            if(Hotel::hotelExists($title)) {
                header("Location: ../view/detail.php?type=hotel&title=" . urlencode($title) . "&error=" . urlencode("This hotel already exists."));
            }
            else {
                Hotel::createHotel($title, $description, $address, $phone, $website, $destination);
                if ($own == '0')
                    User::addBusinessOwner($_SESSION["user"]->getEmail(), $title);

                header("Location: ../view/detail.php?type=hotel&title=" . urlencode($title));
            }
        }
        else if ($type == '1') {
            if(Restaurant::restaurantExists($title)) {
                header("Location: ../view/detail.php?type=restaurant&title=" . urlencode($title) . "&error=" . urlencode("This restaurant already exists."));
            }
            else {
                Restaurant::createRestaurant($title, $description, $address, $phone, $website, $destination);
                if ($own == '0')
                    User::addBusinessOwner($_SESSION["user"]->getEmail(), $title);

                header("Location: ../view/detail.php?type=restaurant&title=" . urlencode($title));
            }
        }
        else
            echo "<h1>Invalid Type.</h1>";
    }
    else header("Location: ../view/RegisterSignIn.php");
}

function addNewRental() {
    $hotel = $_REQUEST["business"];
    $title = str_replace('"', "'", $_REQUEST["title"]);
    $desc = str_replace('"', "'", $_REQUEST["description"]);
    $rental = $_REQUEST["price"];

    HotelRental::addNewRental($hotel, $title, $desc, $rental);
    header("Location: ../view/detail.php?type=hotel&title=" . urlencode($hotel));
}

function addNewDeal() {
    $restaurant = $_REQUEST["business"];
    $title = str_replace('"', "'", $_REQUEST["title"]);
    $desc = str_replace('"', "'", $_REQUEST["description"]);
    $price = $_REQUEST["price"];

    RestaurantDeal::addNewDeal($restaurant, $title, $desc, $price);
    header("Location: ../view/detail.php?type=restaurant&title=" . urlencode($restaurant));
}