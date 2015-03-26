<?php
	$appId = "371666859671907";
	$appSecret = "baf4ee6ac06ec33678ee0ef130469d7e";
	$redirectUrl = "http://localhost/App_WeFound404/index.php";
	$next = "http://localhost/App_WeFound404/index.php";
	$permissions = array('email');

	// try{
	// 	$bdd = new PDO('mysql:host=localhost;dbname=taches;charset=utf8', 'root', '');
	// } catch(Exception $e){
	// 		die('Erreur : '.$e->getMessage());
	// }

	try{
		$bdd = new PDO('mysql:host=ec2-54-228-195-52.eu-west-1.compute.amazonaws.com;
						dbname=d8rdvjqhdf1v8d;charset=utf8',
						'mrzsdpvgwshhui',
						'AFpCYYVZsC73FzHhvwfVcJwYBW');
	} catch(Exception $e){
			die('Erreur : '.$e->getMessage());
	}
?>
