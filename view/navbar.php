<?php require_once("../model/User.php");

echo
'<section class="menu cid-qLeIyzMDVq">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="home.php">
                         <img src="assets/images/mnjkkzzqifopytpboocv-499x498.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="home.php">TravelGuide</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            	<li class="nav-item">
                    <a class="nav-link link text-white display-4" href="Browse.php">
                    	<span class="mbri-search mbr-iconfont mbr-iconfont-btn" style="color: rgb(51, 51, 51);"></span>
                    	Browse
                    </a>
                </li>
                <li class="nav-item">
                	<a class="nav-link link text-white display-4" href="contactus.php">
                		<span class="mbri-search mbr-iconfont mbr-iconfont-btn" style="color: rgb(51, 51, 51);"></span>
                        Contact Us
                    </a>
                </li>';

$user = null;
if(array_key_exists("user", $_SESSION))
    $user = $_SESSION["user"];
if($user != null) {
    echo '<li class="nav-item dropdown open">
                	<a class="nav-link link text-white dropdown-toggle display-4" href="home.php" data-toggle="dropdown-submenu" aria-expanded="true">
                		<span class="mbri-search mbr-iconfont mbr-iconfont-btn" style="color: rgb(51, 51, 51);"></span>';
    echo $user->getName();
    echo '          </a>
                    <div class="dropdown-menu">
                    	<a class="text-white dropdown-item display-4"';

    $check = User::checkBusinessOwner($user->getEmail());
    if($check[0]) {
        echo 'href="detail.php?type=' . $check[1] . '&title=' . urlencode($check[2]) . '">My Business';
    }
    else {
        if(basename($_SERVER['PHP_SELF']) == "detail.php")
            echo 'onclick="claimBusiness(\'' . $_REQUEST["title"] . '\')">Claim this Business';
        else
            echo 'href="newbusiness.php">Add Business';
    }
    //https://mobirise.com">My Business
    echo '
                    	</a>
                    	<a class="text-white dropdown-item display-4" href="../controller/LoginRegisterHandler.php?action=logout">Logout</a>
                    </div>
                </li>
            </ul>';
}
else {
    echo '</ul>
            <div class="navbar-buttons mbr-section-btn">
            	<a class="btn btn-sm btn-primary display-4" href="RegisterSignIn.php">
            		<span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>
                    Register | Sign In
                </a>
            </div>';
}

echo '</div>
    </nav>
</section>';