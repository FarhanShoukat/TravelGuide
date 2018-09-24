<script>
    <?php if(!array_key_exists("user", $_SESSION)) { ?>
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            FB.api('/me', function(response) {
                window.location="../controller/LoginRegisterHandler.php" +
                    "?action=loginFB" +
                    "&id=" + response.id +
                    "&name=" + response.name;
            });
        }
        else {

        }
    }
    <?php } ?>

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '205446396910238',
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v3.0' // use graph api version 2.8
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=205446396910238&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>