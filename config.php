<?php session_start();

// VARIABLES
  $appId = "371666859671907";
  $appSecret = "baf4ee6ac06ec33678ee0ef130469d7e";
  $redirectUrl = "http://localhost/App_WeFound404/index.php";
  $next = "http://localhost/App_WeFound404/index.php";
  $permissions = array('email');
  //Compte admin
  $pwd_admin = "1234";
  $name_admin = "admin";
// FIN VARIABLES

  require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');

  use Facebook\FacebookSession;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookRequest;

//SESSION
  FacebookSession::setDefaultApplication($appId ,$appSecret);
  $helper = new FacebookRedirectLoginHelper($redirectUrl);
   
  try{
    $session = $helper->getSessionFromRedirect();
  }
  catch( FacebookRequestException $ex ){
    echo $ex;
  }
  catch( Exception $ex ){
    echo $ex;
  }

  // session_unset ();
  // session_destroy ();

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

  require_once('connect_bdd.php'); 
  require_once('model.php');
?>