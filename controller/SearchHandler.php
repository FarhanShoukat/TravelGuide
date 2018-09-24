<?php
require_once "../model/Destination.php";
require_once "../model/Attraction.php";
require_once "../model/Hotel.php";
require_once "../model/Restaurant.php";
require_once "../model/TravelInformation.php";

if ($_REQUEST["action"] == "1stSearch") firstSearchHandler();
else if($_REQUEST["action"] == "2ndSearch") secondSearchHandler();
else if($_REQUEST["action"] == "sourceSearch") sourceSearchHandler();
else echo "Invalid Search";
?>

<?php
function firstSearchHandler() {
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $count = 0;

    $rs = Destination::getDestinations($q);
    foreach ($rs as $row) {
        echo '<p class="form-control sr" onclick=\'destResultClicked("' . $row["Name"] . '")\'>' . $row["Name"] . '</p>';
        if($count++ == 4) return;
    }

    $rs = Attraction::getAttractionsWRTNameAndDestination($q);
    foreach ($rs as $row) {
        $search = 'https://www.google.com/search?q=' . urlencode($row["Search"]);
        echo '<a class="form-control sr" href="' . $search . '" onclick="facilityClicked()" target="_blank">' . $row["Search"] . '</a>';
        if($count++ == 4) return;
    }

    $rs = Hotel::getHotelsWRTNameAndDestination($q);
    foreach ($rs as $row) {
        $url = "../view/detail.php?type=hotel&title=" . urlencode($row["Title"]);
        $show = $row["Title"] . ", " . $row["Destination"];
        echo '<a class="form-control sr" href="' . $url . '">' . $show . '</a>';
        if($count++ == 4) return;
    }

    $rs = Restaurant::getRestaurantsWRTNameAndDestination($q);
    foreach ($rs as $row) {
        $url = "../view/detail.php?type=restaurant&title=" . urlencode($row["Title"]);
        $show = $row["Title"] . ", " . $row["Destination"];
        echo '<a class="form-control sr" href="' . $url . '">' . $show . '</a>';
        if($count++ == 4) return;
    }
}

function secondSearchHandler() {
    if($_REQUEST["type"] == "attraction") secondSearchAttractions();
    else if($_REQUEST["type"] == "hotel") secondSearchHotel();
    else if($_REQUEST["type"] == "restaurant") secondSearchRestaurant();
    else if($_REQUEST["type"] == "travel") secondSearchTravel();
    else echo "Invalid Type";
}

function sourceSearchHandler() {
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $count = 0;

    $rs = Destination::getDestinations($q);
    foreach ($rs as $row) {
        echo '<p class="form-control sr" onclick=\'sourceResultClicked("' . $row["Name"] . '")\'>' . $row["Name"] . '</p>';
        if($count++ == 4) return;
    }
}
?>

<?php
function secondSearchAttractions() {
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $d = str_replace('"', "'", $_REQUEST["destination"]);

    $rs = Attraction::getAttractionsOfDestination($d, $q);
    if(sizeof($rs) == 0) echo "";
    foreach ($rs as $row) {
        $search = 'https://www.google.com/search?q=' . urldecode($row["Search"]);
        echo "<div class='attraction'>";
        echo "<h4><a class='attr' href=\"" . $search . "\" target = '_blank' >" . $row["Search"] . "</a></h4>";
        echo "</div><br/>";
    }
}

function secondSearchHotel() {
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $d = str_replace('"', "'", $_REQUEST["destination"]);
    $order = $_REQUEST["order"];
    $min = $_REQUEST["min"];
    $max = $_REQUEST["max"];

    if($order == "Name") {
        $rs = null;
        if($max == "")
            $rs = Hotel::getHotelsOfDestinationNameOrdered($d, $q, $min);
        else
            $rs = Hotel::getHotelsOfDestinationNameOrderedMax($d, $q, $min, $max);
    }
    else if($order == 'Price') {
        if($max == "")
            $rs = Hotel::getHotelsOfDestinationPriceOrdered($d, $q, $min);
        else
            $rs = Hotel::getHotelsOfDestinationPriceOrderedMax($d, $q, $min, $max);
    }
    else if($order == "Rating") {
        if($max == "")
            $rs = Hotel::getHotelsOfDestinationRatingOrdered($d, $q, $min);
        else
            $rs = Hotel::getHotelsOfDestinationRatingOrderedMax($d, $q, $min, $max);
    }
    foreach ($rs as $row) {
        $l = "../view/detail.php?type=hotel&title=" . urlencode($row["Title"]);
        echo "<div class='hotel'>";
        echo "    <div class='row'>";
        echo "        <h4 class='col-md-4'><a class='attr' href=\"" . $l . "\">" . $row["Title"] . "</a></h4>";
        echo "        <span class='col-md-2'>" . $row["Rating"] . "<span class='fa fa-star mystar'></span></span>";
        echo "    </div>";
        if(array_key_exists("Min", $row) && $row["Min"] != null)
            echo "<p>Prices: " . $row["Min"] . " - " . $row["Max"] . "</p>";
        echo "</div><br/>";
    }
}

function secondSearchRestaurant() {
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $d = str_replace('"', "'", $_REQUEST["destination"]);
    $order = $_REQUEST["order"];
    $min = $_REQUEST["min"];
    $max = $_REQUEST["max"];

    if($order == "Name") {
        $rs = null;
        if($max == "")
            $rs = Restaurant::getRestaurantsOfDestinationNameOrdered($d, $q, $min);
        else
            $rs = Restaurant::getRestaurantsOfDestinationNameOrderedMax($d, $q, $min, $max);
    }
    else if($order == 'Price') {
        if($max == "")
            $rs = Restaurant::getRestaurantsOfDestinationPriceOrdered($d, $q, $min);
        else
            $rs = Restaurant::getRestaurantsOfDestinationPriceOrderedMax($d, $q, $min, $max);
    }
    else if($order == "Rating") {
        if($max == "")
            $rs = Restaurant::getRestaurantsOfDestinationRatingOrdered($d, $q, $min);
        else
            $rs = Restaurant::getRestaurantsOfDestinationRatingOrderedMax($d, $q, $min, $max);
    }
    else {
        echo "Invalid Order Request";
        return;
    }
    foreach ($rs as $row) {
        $l = "../view/detail.php?type=restaurant&title=" . urlencode($row["Title"]);
        echo "<div class='hotel'>";
        echo "    <div class='row'>";
        echo "        <h4 class='col-md-4'><a class='attr' href=\"" . $l . "\">" . $row["Title"] . "</a></h4>";
        echo "        <span class='col-md-2'>" . $row["Rating"] . "<span class='fa fa-star mystar'></span></span>";
        echo "    </div>";
        if(array_key_exists("Min", $row) && $row["Min"] != null)
            echo "<p>Prices: " . $row["Min"] . " - " . $row["Max"] . "</p>";
        echo "</div><br/>";
    }
}

function secondSearchTravel() {
    $type = $_REQUEST["travel"];
    $source = str_replace('"', "'", $_REQUEST["source"]);
    $d = str_replace('"', "'", $_REQUEST["destination"]);
    $q = str_replace('"', "'", $_REQUEST["q"]);
    $order = $_REQUEST["order"];
    $min = $_REQUEST["min"];
    $max = $_REQUEST["max"];

    if($type == "air")
        $type = 0;
    else if($type == "road")
        $type = 1;
    else {
        echo "Invalid Travel Type";
        return;
    }

    $rs = null;
    if($order == 'Company Name') {
        if($max == "")
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationCompanyOrdered($source, $d, $type, $q, $min);
        else
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationCompanyOrderedMax($source, $d, $type, $q, $min, $max);
    }
    else if($order == "Price") {
        if($max == "")
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationPriceOrdered($source, $d, $type, $q, $min);
        else
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationPriceOrderedMax($source, $d, $type, $q, $min, $max);
    }
    else if($order == "Date") {
        if($max == "")
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationDateOrdered($source, $d, $type, $q, $min);
        else
            $rs = TravelInformation::getTravelInformationOfSourceToDestinationDateOrderedMax($source, $d, $type, $q, $min, $max);
    }
    else {
        echo "Invalid Order Request";
        return;
    }

    foreach ($rs as $row) {
        echo "<div class='travel'>";
        echo "    <h4>" . $row["TravelCompany"] . "</h4>";
        echo "    <span class='d-block'>Date: " . $row["Date"] . "</span>";
        echo "    <span class='d-block'>Time: " . $row["Time"] . "</span>";
        echo "    <span class='d-block'>Price: " . $row["Price"] . "</span>";
        echo "</div><br/>";
    }
}
?>
