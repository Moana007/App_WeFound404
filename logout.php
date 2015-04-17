<?php 

session_start();
session_unset();
session_destroy();

// require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');
// use Facebook\FacebookRedirectLoginHelper;
// $helper = new FacebookRedirectLoginHelper($redirectUrl);
// $helper->getLogoutUrl($session, $next);

header("location:index.php");	

?>