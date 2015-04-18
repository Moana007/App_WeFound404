<?php session_start();

	$appId = "371666859671907";
	  $appSecret = "baf4ee6ac06ec33678ee0ef130469d7e";
	  if($_SERVER['SERVER_NAME'] == "localhost") {
	    $redirectUrlNewsletter = "http://localhost/App_WeFound404/add_fb_newsletter.php";
    	$next = "http://localhost/App_WeFound404/index.php";
	  } else {
	    $redirectUrlNewsletter = "https://appwefound404.herokuapp.com/add_fb_newsletter.php";
	    $next = "https://appwefound404.herokuapp.com/index.php";
	  }
	  $permissions = array('email');

	require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');
	
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;

	FacebookSession::setDefaultApplication($appId ,$appSecret);
	$helperNewsletter = new FacebookRedirectLoginHelper($redirectUrlNewsletter);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Vote du meilleur redacteur WeFound404</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/script_social.js"></script>
  <link rel="icon" type="image/png" href="img/logo_wefound404.png" /> 
  <meta property="og:title" content="Vote du meilleur redacteur WeFound404" />
  <meta property="og:description" content="Venez voter pour le redacteur du mois de WeFound404 !" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://appwefound404.herokuapp.com/" />
  <meta property="og:image" content="img/logo_wefound404.png" />

</head>
<body>

<div class="main2" style="width:760px;height:150px;padding-top:20px;margin:0 auto;background-color:rgb(231,176,118);">
	<h2 style="text-align: center;">Confirmation</h2>
	<a href="<?= $helperNewsletter->getLoginUrl($permissions); ?>"><button style="margin-left:222px; margin-top: 30px;" type="button" class="btn btn_green">Oui, je veux m'inscrire à la newsletter !</button></a>
</div>

</body>
</html>