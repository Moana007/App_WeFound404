<?php session_start();
    if (!isset($_SESSION['admin'])) { 
      $_SESSION['admin'] = 0;
    }

    require_once('../vars.php');

    if(isset($_POST['name_admin'])) {
        $name_form = $_POST['name_admin'];
        $pwd_form = $_POST['pwd_admin'];
        // $pwd_admin (dans vars.php) 
        // $name_admin
        if($name_form == $name_admin && $pwd_form == $pwd_admin){
            $_SESSION["admin"] = 1;
        }
        else { echo "Erreur Identifiants"; }
    }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Administration de l'application de vote WeFound404</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/script.js"></script>
</head>
<body>


<!-- - - - - - - - - - -  -->
<!-- - SI USER CONNECTE - -->
<!-- - - - - - - - - - -  -->
<?php if ($_SESSION['admin'] == 1) {
            $req = $bdd->prepare('SELECT * FROM redactor WHERE actif = 1 ORDER BY nb_vote DESC');
            $req->execute(); 
            $redactors = $req->fetchAll();

            $today = date("Y-m-d H:i:s"); 
?>


    <h1>Partie Admin de l'application WeFound404</h1>
    <a href="logout.php">Déconnexion</a>
    <br>

    <h2>Resultat du vote le <?= $today ?></h2>
    <?php foreach($redactors as $redactor){ ?>
        <h3><?= $redactor['nom']." ".$redactor['prenom']; ?></h3>
        <p style="margin-top:-10px;">Votes: <?= $redactor['nb_vote']; ?> </p>
        <br>
    <?php } ?>

<!-- - - - - - - - - - -  -->
<!-- SI USER NON CONNECTE -->
<!-- - - - - - - - - - -  -->
<?php } else { ?>
    <h1> Connexion a la partie Admin de WeFound404</h1>
    <form action="index.php" method="POST" id="form_admin">
        <input type="text" name="name_admin" required></input>
        <input type="password" name="pwd_admin" required></input>
        <button class="btn btn_orange">Connexion</button>
    </form>

<?php } ?>
    
</body>
</html>