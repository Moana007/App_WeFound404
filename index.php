﻿<?php session_start();
  require_once('vars.php');
  require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');

  use Facebook\FacebookSession;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookRequest;

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
  require_once('model.php');

?>



<!-- -  - - - - - - - - - - - - - - - - -->
<!-- - - - - - - DEBUT HTML - - - - - - -->
<!-- - - - - - - - - - - - - - - - - -  -->
<!DOCTYPE html>
<html>
<head>
  <title>Title of the document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/script.js"></script>
</head>
<body>

<?php
  if (!isset($vote))
    $vote = 0;

  if(!isset($session)) {
  $loginUrl = $helper->getLoginUrl($permissions);
?>
  <div id="main">
    <!-- VOTE REDACTEUR -->
    <section id="col_left">
      <h1>Le meilleur rédacteur du mois !</h1><br>
      <p class="subtitle">Votez pour le meilleur rédacteur du mois de WeFound404 et gagné une interview avec le gagnant !</p>
      <a href="<?= $loginUrl ?>"><button type="button" class="btn btn_green">Connectez vous pour voter !</button></a>
      <p class="text_under_btn">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor . Laboris nisi ut aliquip ex ea commodo consequat.<br>Duis aute irure velit esse cillum dolore eu fugiat nulla pariatur. Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>

   <!-- NEWSLETTER -->
    <section id="col_right">
      <h1>Souscrivez à la newsletter !</h1><br>
      <p class="subtitle">Inscrivez vous à la newsletter et recevez chaque mois les meilleurs actualités postées sur WeFound404, ainsi que les événements à venir pour rester connecté à l'information.</p>
      <span class="msg_succes"></span>
      <form action="model.php" method="POST" id="form_newsletter">
          <input type="mail" id="newsl_mail" name="newsl_mail" onclick="Test_adresse_email();" placeholder="votreemail@mail.com" required></input>
          <span class="msg_error1"></span>
          <button class="btn btn_orange">S'inscire à la newsletter</button>
      </form>
      <p class="text_under_btn">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor . Laboris nisi ea commodo consequat.<br>Duis aute irure velit esse cillum dolore eu fugiat nulla pariatur. Sunt in culpa deserunt mollit anim id est laborum.</p>
    </section>
    <div class="clear"></div>

  </div>



<?php } else if ($session && $vote == 1) { ?>
  <!-- PAGE DE FIN - A VOTE -->
  <h1> Voté !!</h1>

<?php } else if ($session && $vote == 0) { ?>

<div id="main2">
  <header>
    <h1><?= $name = $user_profile->getName(); ?>, voter pour votre redacteur du mois !</h1>
    <p>Et recevez une interview avec votre rédacteur favoris.</p>
  </header>
  <div class="content">
    <h2>Selectionner votre rédacteur favoris :</h2>
    <div class="bloc_redacteur">
      <form name="form_vote" action="index.php" method="POST">
        <?php foreach($redactors as $redactor): ?>
          <article>
            <img src="" alt="">
            <p><?= $redactor["nom"]." ".$redactor["prenom"]; ?></p>
            <input  type="radio" name="name_redactor" value="<?= $redactor["id"]; ?>"><br>
            <a href="<?= $redactor["url_profil"]; ?>">Plus de détails</a>
          </article>
        <?php endforeach ?>
        <button style="float: right" type="submit" class="btn btn_green">Voter !</button>
      </form>
    </div>
  </div>

</div>

  <!-- LOGOUT   -->
    <p><a href="<?= $logouturl ?>" >Quitter</a></p>
  <!-- Div Facebook Buttons like & share -->
  <div class="fb-like" data-href="https://www.facebook.com/nike"
    data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div><br>

<?php } ?>
  
</body>
</html> 

<?php
//FB like & Share
echo '<div id="fb-root"></div>';
echo '<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1528275870769644&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
?>
<!-- <div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '371666859671907',
      xfbml      : true,
      version    : 'v2.2'
    });

    // ADD ADDITIONAL FACEBOOK CODE HERE
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->

