<?php

require_once('../config.php');

if(isset($_POST['name_admin'])) {

	$name_form = $_POST['name_admin'];
	$pwd_form = $_POST['pwd_admin'];
	// $pwd_admin (dans vars.php) 
	// $name_admin

	if($name_form == $name_admin && $pwd_form == $pwd_admin){
		
		$_SESSION["admin"] = 1;
		header('Location: index.php'); // FAIRE REQUETE ET REDIRECT EN AJAX
	}
	else {
		echo "Erreur Identifiants";
	}

}