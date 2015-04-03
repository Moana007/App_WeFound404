<?php

	// if($_SERVER['SERVER_NAME'] == "localhost") {

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=taches;charset=utf8', 'root', '');
		} catch(Exception $e){
				die('Erreur : '.$e->getMessage());
		}

	// } else {
  
	//    $host_bdd='ec2-54-228-195-52.eu-west-1.compute.amazonaws.com';
	//    $name_bdd='d8rdvjqhdf1v8d';
	//    $user_bdd='mrzsdpvgwshhui';
	//    $pass_bdd='AFpCYYVZsC73FzHhvwfVcJwYBW';
	  
	//    try{
	//       $bdd = new PDO ("pgsql:host=".$host_bdd.";dbname=".$name_bdd."", "".$user_bdd."", "".$pass_bdd."") or die(print_r($bdd->errorInfo()));
	//       $bdd->exec("SET NAMES UTF8");
	//       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	// 	}
	      
	//    catch(Exeption $e){
	//       die("Erreur!".$e->getMessage());
	//    }

	// }
?>
