<?php
require_once "../model/User.php";
require_once "../model/Hotel.php";
require_once "../model/Restaurant.php";
require_once "../model/HotelRental.php";
require_once "../model/RestaurantDeal.php";
require_once "../model/BusinessOwner.php";

session_start();
$user = null;
if(array_key_exists("user", $_SESSION))
    $user = $_SESSION["user"];

$obj = null;
if($_REQUEST["type"] == "hotel") {
    $obj = new Hotel($_REQUEST["title"]);
}
else {
    $obj = new Restaurant($_REQUEST["title"]);
}

if($obj == null || $obj->getTitle() == null) {
    echo "<h1>Nothing Found</h1>";
}
else {
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.6.5, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/images/mnjkkzzqifopytpboocv-499x498.png" type="image/x-icon">
    <meta name="description" content="Website Maker Description">
    <title><?php echo $obj->getTitle() ?> - TravelGuide</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    <style>
        .myButtons1, .myButtons2{
            border-radius: 12px;
            font-size: 16px;
            padding: 9px 25px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
        }
        .myButtons1:hover, .myButtons2:hover { box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19); }
        .myButtons1{
            border: 2px solid #f44336;
            background-color: white;
        }
        .myButtons2{
            margin-left: 6px;
            color: white;
            border: #f44336;
            background-color: #f44336;
        }
        div>input.d-block, .price { border: none; }
        span.title {
            font-size: 25px;
            font-weight: bold;
        }
        div>div>ul>li:hover{ background-color: #DCDCDC; }
        span.mystar{ margin-left: 2px; color: #FFD700; }
        span.mystr { font-size: medium; margin-left: 5px; vertical-align: middle }

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tab button:hover { background-color: #ddd; }
        .tab button.active { background-color: #ccc; }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        fieldset, label { margin: 0; padding: 0; }
        .rating {
            border: none;
            float: left;
        }
        .rating > input { display: none; }
        .rating > label:before {
            margin: 5px;
            font-size: 1.25em;
            display: inline-block;
            content: "\f005";
        }
        .rating > label {
            color: #ddd;
            float: right;
        }
        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */
        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }
    </style>

    <script>
        function tabClicked(evt, cityName) {
            let i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            document.getElementById(cityName + '-button').className += " active";
        }

        function claimBusiness(business) {
            let xmlHttp = getXMLHttp();
            xmlHttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    if(this.responseText === '1')
                        alert('Claim Request Submitted.\nWe will contact you very soon.');
                }
            };
            xmlHttp.open("POST", "../controller/BusinessHandler.php?action=claim&business=" + business, true);
            xmlHttp.send();
        }

        function submitRating() {
            let rating = null;
            try {
                rating = document.querySelector('input[name="rating"]:checked').value;
            }
            catch (e) {
                alert("Please rate first!");
                return;
            }
            let review = document.getElementById("review").value;

            let xmlHttp = getXMLHttp();
            xmlHttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    if(this.responseText === '1') {
                        alert('Rated Successfully.');
                        getReviews();
                    }
                }
            };
            xmlHttp.open("POST", "../controller/BusinessHandler.php" +
                "?action=rate" +
                "&type=" + "<?php echo $_REQUEST["type"] ?>" +
                "&title=" + "<?php echo urlencode($obj->getTitle()) ?>" +
                "&rating=" + rating +
                "&review=" + review, true);
            xmlHttp.send();
        }

        function getXMLHttp() {
            if (window.XMLHttpRequest)
                return new XMLHttpRequest();     // code for IE7+, Firefox, Chrome, Opera, Safari
            else
                return new ActiveXObject("Microsoft.XMLHTTP");   // code for IE6, IE5
        }

        function getReviews() {
            let xmlHttp = getXMLHttp();
            xmlHttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("Reviews").innerHTML = this.responseText;
                }
            };

            let url = "";

            <?php
            if($user == null || filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            ?>
            url = "../controller/BusinessHandler.php" +
                "?action=getReviews" +
                "&type=" + "<?php echo $_REQUEST["type"] ?>" +
                "&title=" + "<?php echo urlencode($obj->getTitle()) ?>";
            xmlHttp.open("POST", url, true);
            xmlHttp.send();
            <?php
            }
            else
            { ?>
            FB.getLoginStatus(function(response) {
                FB.api('/me/friends', {fields: 'name,id'},
                    function(response) {
                        if(response.data.length === 0) {
                            url = "../controller/BusinessHandler.php" +
                                "?action=getReviews" +
                                "&type=" + "<?php echo $_REQUEST["type"] ?>" +
                                "&title=" + "<?php echo urlencode($obj->getTitle()) ?>";
                            xmlHttp.open("POST", url, true);
                            xmlHttp.send();
                        }
                        else {
                            url = "../controller/BusinessHandler.php" +
                                "?action=getFacebookReviews" +
                                "&type=" + "<?php echo $_REQUEST["type"] ?>" +
                                "&title=" + "<?php echo urlencode($obj->getTitle()) ?>" +
                                "&friendsCount=" + response.data.length;
                            for(let i = 0; i < response.data.length; i++) {
                                url += "&" + i + "=" + response.data[i].id;
                            }
                            //alert(url);
                            xmlHttp.open("POST", url, true);
                            xmlHttp.send();
                        }
                    });
            });
            <?php } ?>
        }

        <?php if($user != null && BusinessOwner::checkBusinessOwner($user->getEmail(), $_REQUEST["title"])) { ?>
        function addDealRental() {
            let title = document.getElementById("newTitle").value;
            let desc = document.getElementById("myDesc").value;
            let price = document.getElementById("price").value;

            window.location = "../controller/BusinessHandler.php" +
                "?action=newDealRental" +
                "&type=" + "<?php echo $_REQUEST["type"] ?>" +
                "&business=" + "<?php echo urlencode($obj->getTitle()) ?>" +
                "&title=" + title +
                "&description=" + desc +
                "&price=" + price;
        }
        <?php } ?>
    </script>

</head>
<body onload="tabClicked(event, 'Deals'); getReviews();
<?php
if(array_key_exists("error", $_REQUEST))
    echo "alert('" . $_REQUEST["error"] . "')";
?>
">
<?php if($user != null && !filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) { ?>
    <div id="fb-root"></div>
    <?php require_once "Facebook.php";
}
include 'navbar.php';?>

<section class="engine"><a href="https://mobirise.ws/e">best web building software</a></section><section class="cid-qLFfXkpEoO mbr-fullscreen mbr-parallax-background" id="header2-1a">
    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    <?php
                    echo $obj->getTitle()
                    ?>
                </h1>

                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    <?php
                    if($obj->getDescription() != null && $obj->getDescription() != '') {
                        if (strlen($obj->getDescription()) > 155)
                            echo substr($obj->getDescription(), 0, 155) . "...</br>";
                        else
                            echo $obj->getDescription() . "</br>";
                    }
                    echo $obj->getAddress() . "</br>";
                    echo $obj->getPhone() . "</br>";
                    if($obj->getWebsite() != null && $obj->getWebsite() != '') {
                        echo '<a class="d-block" href="' . $obj->getWebsite() . '" target="_blank">' . $obj->getWebsite() . '</a>';
                    }
                    ?>
                </p>
                <?php if($user != null) { ?>
                <div class="mbr-section-btn"><a class="btn btn-md btn-secondary display-4" data-toggle="modal" data-target="#myModal">Rate</a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if($user != null) { ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-weight-bold" style="margin-bottom: 0">Rate:</p>
                <fieldset class="rating" style="margin-bottom: 20px">
                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full fa fa-star" for="star5" title="Loved It - 5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full fa fa-star" for="star4" title="lLiked It - 4 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full fa fa-star" for="star3" title="It's OK - 3 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full fa fa-star" for="star2" title="Disliked It - 2 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full fa fa-star" for="star1" title="Hated It - 1 star"></label>
                </fieldset>
                <textarea class="form-control" id="review" rows="4" title="Write your review here" placeholder="Write your review here"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="myButtons1" id="myButtons1"  data-dismiss="modal">Close</button>
                <button type="button" class="myButtons2" id="myButtons2" onclick="submitRating()">Submit</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<section class="cid-qLF9i599ha">
    <div style="background-color: white; padding: 0">
        <div class="tab">
            <button class="tablinks active" id="Deals-button" onclick="tabClicked(event, 'Deals')">
                <?php
                if($_REQUEST["type"] == "hotel")
                    echo "Rentals";
                else
                    echo "Deals";
                ?>
            </button>
            <button class="tablinks" id="Reviews-button" onclick="tabClicked(event, 'Reviews')">Reviews</button>
        </div>

        <div id="Deals" class="tabcontent">
            <?php
            $rs = null;
            if($_REQUEST["type"] == "hotel")
                $rs = HotelRental::getRentalsOfHotel($obj->getTitle());
            else
                $rs = RestaurantDeal::getDealsOfRestaurant($obj->getTitle());

            foreach ($rs as $row) {
                echo '<div>';
                echo '<h3>' . $row["Title"] . '</h3>';
                echo '<span class="d-block">' . $row["Description"] . '</span>';
                echo '<p>Price: ' . $row["Price"] . '</p>';
                echo '</div>';
            }
            if($user != null && BusinessOwner::checkBusinessOwner($user->getEmail(), $_REQUEST["title"])) {
                echo '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAdd">Add</button>';
            }
            ?>
        </div>

        <div id="Reviews" class="tabcontent">
        </div>
    </div>
</section>

<?php if($user != null && BusinessOwner::checkBusinessOwner($user->getEmail(), $_REQUEST["title"])) { ?>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-weight-bold" style="margin-bottom: 0">Title:</p>
                    <input type="text" class="form-control" id="newTitle" maxlength="100" title="Title">
                    <p class="font-weight-bold" style="margin-bottom: 0; margin-top: 10px">Description:</p>
                    <textarea class="form-control" id="myDesc" maxlength="1000" rows="3" title="Write your review here" placeholder="Description"></textarea>
                    <p class="font-weight-bold" style="margin-bottom: 0; margin-top: 10px">
                    <?php
                    if($_REQUEST["type"] == "hotel")
                        echo 'Rental:';
                    else
                        echo 'Price:';
                    ?>
                    </p>
                    <input type="number" class="form-control" id="price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="myButtons1" data-dismiss="modal">Cancel</button>
                    <button type="button" class="myButtons2" onclick="addDealRental()">Add</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer.php';?>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/theme/js/script.js"></script>


<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
</body>
</html>

<?php } ?>