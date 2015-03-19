<?php
	$appId = "371666859671907";
	$appSecret = "baf4ee6ac06ec33678ee0ef130469d7e";
	$redirectUrl = "http://localhost/App_WeFound404/index.php";
	$next = "http://localhost/App_WeFound404/index.php";
	$permissions = array('email');

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=taches;charset=utf8', 'root', '');
	} catch(Exception $e){
			die('Erreur : '.$e->getMessage());
	}
?>
