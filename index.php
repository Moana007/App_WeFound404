﻿<?php require_once('config.php'); ?>
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
  <div id="fb-root"></div>
<?php
  if (!isset($vote))
    $vote = 0;

  if(!isset($session)) {
?>
  <div id="main">
    <!-- VOTE REDACTEUR -->
    <section id="col_left">
      <h1>Le meilleur rédacteur du mois !</h1><br>
      <p class="subtitle">Votez pour le meilleur rédacteur du mois de WeFound404 et gagné une interview avec le gagnant !</p>
      <a href="<?= $helper->getLoginUrl($permissions); ?>"><button type="button" class="btn btn_green">Connectez vous pour voter !</button></a>
      <p class="text_under_btn">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor . Laboris nisi ut aliquip ex ea commodo consequat.<br>Duis aute irure velit esse cillum dolore eu fugiat nulla pariatur. Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>

   <!-- NEWSLETTER -->
  
    <section id="col_right">
      <h1>Souscrivez à la newsletter !</h1><br>
      <p class="subtitle">Inscrivez vous à la newsletter et recevez chaque mois les meilleurs actualités postées sur WeFound404, ainsi que les événements à venir pour rester connecté à l'information.</p>
      <span class="msg_succes"></span>
      <form action="index.php" method="POST" id="form_newsletter">
          <input type="mail" id="newsl_mail" name="newsl_mail" onclick="Test_adresse_email();" placeholder="votreemail@mail.com" required>
          <span class="msg_error1"></span>
          <button class="btn btn_orange">S'inscire à la newsletter</button>
      </form>
      <div>
        <p class="text_news">Ou en vous connectant avec votre compte Facebook<p>
        <form action="valid_newsletter.php" method="POST" id="form_newsletter">
          <input type="hidden" name="newsletter_fb">
          <button type="submit" class="btn btn_orange2">S'inscrire via FB</button></a> 
        </form>
      </div>
      <p class="text_under_btn">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor . Laboris nisi ea commodo consequat.<br>Duis aute irure velit esse cillum dolore eu fugiat nulla pariatur. Sunt in culpa deserunt mollit anim id est laborum.</p>
    </section>
    <div class="clear"></div>

  </div>


<?php } else if ($session && $vote == 0) { ?>

<div id="main2">
  <header>
    <h1><?= $name = $user_profile->getName(); ?>, voter pour votre redacteur du mois !</h1>
    <p>Et recevez une interview avec votre rédacteur favoris.</p>
  </header>
  <div class="content">
    <h2>Selectionner votre rédacteur favoris :</h2>
    <form name="form_vote" action="index.php" method="POST">
      <div class="bloc_redacteur">
        <?php foreach($redactors as $redactor): ?>
          <article>
            <img src="" alt="">
            <p><?= $redactor["nom"]." ".$redactor["prenom"]; ?></p>
            <input  type="radio" name="name_redactor" value="<?= $redactor["id"]; ?>"><br>
            <a href="<?= $redactor["url_profil"]; ?>">Plus de détails</a>
          </article>
        <?php endforeach ?>
      </div>
      <button type="submit" class="btn btn_green">Voter !</button>
      <div class="clear"></div>
    </form>
  </div>

  <a class="retour2" href="function/logout.php"><< Revenir à l'accueil</a>
</div>





<?php } else if ($session && $vote == 1) { ?>
  <!-- PAGE DE FIN - A VOTE -->
  <div id="main3">

    <header>
      <h1><?= $name = $user_profile->getName(); ?>, merci d'avoir voté pour </h1>
      <h2><?= $nom_redact_vote; ?></h2>
      <p>Et maintenant fait parler du vote à tes amis !</p>
    </header>

    <div class="bloc_social">
      <!-- url application fb: https://appwefound404.herokuapp.com/ -->
      <div class="btn_social">
        <p><span class="bold_red">LIKE</span> ou <span class="bold_red">PARTAGE</span> l'application !</p>
        <div class="fb-like" data-href="https://appwefound404.herokuapp.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
      </div>
      
      <div class="btn_social">
        <p>Dit à tous le monde pour qui tu as voté !<button type="button"
         onclick="ShareVote('<?php echo $nom_redact_vote; ?>');">Partager mon vote</button></p>
      </div>

      <div class="btn_social">
        <p><span class="bold_red">RECOMMANDEZ</span> la page WeFound404.</p>
        <div class="fb-like" data-href="https://www.facebook.com/wefound404" data-layout="button" data-action="recommend" data-show-faces="false" data-width="700" data-share="false"></div>
      </div>
      
      <div class="btn_social">
        <p><span class="bold_red">INVITEZ</span> vos amis a voté.<br><button type="button" onclick="AppRequestVote();">Inviter des amis</button></p>
      </div>

      <div class="clear"></div>
    </div>

    <div class="visit_site">
      <p>Ou bien visiter notre <a href="http://wefound404.fr">site WeFound404</a></p>
    </div>
    
    <a class="retour" href="function/logout.php"><< Revenir à l'accueil</a>

    <br><br><br><br><br>
    <div class="comments">
      <h4>N'hésite pas à laisser un commentaires pour vous exprimer au sujet du vote</h4>
      <div class="fb-comments" data-href="https://appwefound404.herokuapp.com/" data-numposts="5" data-colorscheme="light"></div>
    </div>
  
    <p style="text-align: center; font-size: 1.5em; margin: 130px 0 20px 0 ;">By L.G. Moana - ESGI 2015</p>
  
  </div>
  


<?php } ?>
</body>
</html>

