<?php session_start();

 	require_once('function/connect_bdd.php');

 	// VARIABLES
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
	// FIN VARIABLES 

	require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');
	
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;


	FacebookSession::setDefaultApplication($appId ,$appSecret);
	$helperNewsletter = new FacebookRedirectLoginHelper($redirectUrlNewsletter);


	  try{
	    $session = $helperNewsletter->getSessionFromRedirect();
	  }
	  catch( FacebookRequestException $ex ){
	    echo $ex;
	  }
	  catch( Exception $ex ){
	    echo $ex;
	  }


	  // see if we have a session in $_Session[]
	  if(isset($_SESSION['token'])){
	      // We have a token, is it valid?
	      $session = new FacebookSession($_SESSION['token']);
	      try{
	          $session->Validate($appId ,$appSecret);
	      }
	      catch( FacebookAuthorizationException $ex){
	          // Session is not valid any more, get a new one.
	          $session ='';
	      }
	  }
	   
	  // see if we have a session
	  if ( isset( $session ) ){  
	      // set the PHP Session 'token' to the current session token
	      $_SESSION['token'] = $session->getToken();
	  }
	// FIN SESSION


	$user_profile = (new \Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(Facebook\GraphUser::className());

	$name = $user_profile->getName();
	$mail = $user_profile->getProperty('email');
	$id_fb = $user_profile->getProperty('id');

	$req2 = $bdd->prepare('SELECT id_fb,vote,id FROM users WHERE id_fb = :fb');
	$req2->execute((array('fb' => $id_fb)));
	$result = $req2->fetch();



	$req = $bdd->prepare('SELECT mail FROM newsletter WHERE mail = :mail');
	$req->execute(array('mail' => $mail));
	$result = $req->fetch();

	if($result["mail"] != $mail){
		$req = $bdd->prepare('INSERT INTO newsletter(mail) VALUES(:mail)');
		$req->execute(array('mail' => $mail));
		
		$logouturl = $helperNewsletter->getLogoutUrl($session, $next);
		sleep(3);
		session_unset();
		session_destroy();
		echo "<script>alert('Inscription à la Newsletter validé !');window.location = 'index.php';</script>";
	}
	else {
		

		$logouturl = $helperNewsletter->getLogoutUrl($session, $next);
		session_unset();
		session_destroy();
		echo "<script>alert('Vous etes déjà inscrit !');window.location = 'index.php';</script>";
	}




?>