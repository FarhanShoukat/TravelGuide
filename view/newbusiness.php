<?php
require_once("../model/User.php");
require_once "../model/Destination.php";
session_start();

$user = null;
if(array_key_exists("user", $_SESSION))
    $user = $_SESSION["user"];
else
    header("Location: RegisterSignIn.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.6.5, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mnjkkzzqifopytpboocv-499x498.png" type="image/x-icon">
    <meta name="description" content="Web Site Builder Description">
    <title>NewBusiness - TravelGuide</title>
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
        function validateTitle() {
            let e = document.getElementById('title-form1-19');
            let v = e.value;
            if(/\d/.test(v)) {
                e.setCustomValidity('Title cannot have numbers.');
                return false;
            }
            e.setCustomValidity('');
            return true;
        }
    </script>
</head>
<body>
<?php include 'navbar.php';?>

<section class="engine"><a href="https://mobirise.ws/q">offline website creator download</a></section><section class="mbr-section form1 cid-qLFa0N5gYO" id="form1-19">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">Add New Business</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8">
                <form class="block mbr-form" action="../controller/BusinessHandler.php?action=newBusiness" method="post">
                    <div class="row row-sm-offset">
                        <div class="col-md-6 multi-horizontal" data-for="name">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="title-form1-19">Name</label>
                                <input type="text" class="form-control" name="title" data-form-field="Title" required id="title-form1-19" placeholder="Business Title" onkeypress="this.setCustomValidity('')" onblur="validateTitle()">
                            </div>
                        </div>
                        <div class="col-md-6 multi-horizontal" data-for="phone">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-19">Phone</label>
                                <input type="number" class="form-control" name="phone" data-form-field="Phone" required id="phone-form1-19" onkeypress="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 multi-horizontal" data-for="type">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="location-form1-19">Type</label>
                                <select class="form-control" name="destination" id="location-form1-19">
                                    <?php
                                    $rs = Destination::getDestinationsNameOrdered('');
                                    foreach ($rs as $row) {
                                        echo '<option value="' . $row["Name"] . '">' . $row["Name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 multi-horizontal" data-for="type">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="type-form1-19">Type</label>
                                <select class="form-control" name="businessType" id="type-form1-19">
                                    <option value="0">Hotel</option>
                                    <option value="1">Restaurant</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 multi-horizontal" data-for="own">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="own-form1-19">Do you own this place?</label>
                                <select class="form-control" name="own" id="own-form1-19">
                                    <option value="0">Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 multi-horizontal" data-for="address">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="address-form1-19">Address</label>
                                <input type="text" class="form-control" name="address" data-form-field="Address" required id="address-form1-19">
                            </div>
                        </div>
                        <div class="col-md-6 multi-horizontal" data-for="website">
                            <div class="form-group">
                                <label class="form-control-label mbr-fonts-style display-7" for="website-form1-19">Website (if any)</label>
                                <input type="text" class="form-control" name="website" data-form-field="Website" id="website-form1-19">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" data-for="description">
                        <label class="form-control-label mbr-fonts-style display-7" for="description-form1-19">Describe us about this place (Optional)</label>
                        <textarea type="text" class="form-control" name="description" rows="3" data-form-field="Message" id="description-form1-19"></textarea>
                    </div>

                    <div class="input-group-btn col-md-12" style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-form display-4">ADD</button></div>
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