<?php 

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;


if(isset($_POST['newsl_mail'])) {

	$mail_news = $_POST['newsl_mail'];
	$req = $bdd->prepare('SELECT mail FROM newsletter WHERE mail = :mail');
	$req->execute(array('mail' => $mail_news));
	$result = $req->fetch();

	if($result["mail"] != $_POST['newsl_mail']){
		$req = $bdd->prepare('INSERT INTO newsletter(mail) VALUES(:mail)');
		$req->execute(array('mail' => $_POST['newsl_mail']));
		
		sleep(3);
		header('Location: index.php'); // FAIRE REQUETE ET REDIRECT EN AJAX
	}
	else { echo "vous etes deja inscrit";}
}

if (isset($session)) {

		$user_profile = (new \Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(Facebook\GraphUser::className());

		$name = $user_profile->getName();
		$mail = $user_profile->getProperty('email');
		$genre = $user_profile->getProperty('gender');
		$id_fb = $user_profile->getProperty('id');

		  
		$req2 = $bdd->prepare('SELECT id_fb,vote,id FROM users WHERE id_fb = :fb');
		$req2->execute((array('fb' => $id_fb)));
		$result = $req2->fetch();
		$vote = $result["vote"];
		$id_user = $result["id"];

	// ---------------------------------------------------------
	// ---------------------- VOTE USER ------------------------
	// ---------------------------------------------------------
	if( isset($_POST['name_redactor']) ) {

		//Recupére le nb de vote et on ajoute +1
		$id_redactor = $_POST['name_redactor'];
		$req = $bdd->prepare('SELECT nb_vote FROM redactor WHERE id = :id_redactor');
		$req->execute((array('id_redactor' => $id_redactor)));
		$result = $req->fetch();
		$nb_votePlusUn = $result["nb_vote"] + 1;

		$req2 = $bdd->prepare('UPDATE redactor SET nb_vote = :nb_votePlusUn WHERE id = :id_redactor');
		$req2->execute(array( 'nb_votePlusUn' => $nb_votePlusUn, 'id_redactor' => $id_redactor ));


		//VOTE USER passe de 0 à 1 en votant
		$user_profile = (new \Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(Facebook\GraphUser::className());
		$id_fb = $user_profile->getProperty('id');
		$vote = 1;

		$req3 = $bdd->prepare('UPDATE users SET vote = :vote WHERE id_fb = :id_fb');
		$req3->execute(array( 'vote' => $vote, 'id_fb' => $id_fb ));
		
		
		// Enregistre dans la table votes pour savoir qui a voté pour qui
		$req5 = $bdd->prepare('INSERT INTO votes(id_user, id_redactor)
								VALUES (:id_user, :id_redactor)');
		$req5->execute(array( 'id_user' => $id_user, 'id_redactor' => $id_redactor ));


		header('Location: index.php');

	}
	else if ($vote == 1) {
		// select le redacteur pour lequel a voté l'utilisateur
		$req = $bdd->prepare('SELECT nom, prenom 
								FROM votes, users 
								WHERE votes.id_user = users.id');
		$req->execute();
		$result = $req->fetch();
		$nom_redact_vote = $result["nom"]." ".$result["prenom"];
	}
	
	// ---------------------------------------------------------
	// ---------------------- USER INFO ------------------------
	// Récupération des infos user via SDK FB, et update en BDD
	// ---------------------------------------------------------
	else {

		if($result["id_fb"] != $id_fb){
			$req = $bdd->prepare('INSERT INTO users(Nom, mail, genre, id_fb) VALUES(:name, :mail, :genre, :id_fb)');
			$req->execute(array(
				'name' => $name,
				'mail' => $mail,
				'genre' => $genre,
				'id_fb' => $id_fb
			));
		}


		$req3 = $bdd->prepare('SELECT * FROM redactor WHERE actif = 1');
		$req3->execute();
		$redactors = $req3->fetchAll();


	// -------------------------------
	// ------ LOGOUT SESSION FB ------
	// -------------------------------
	$logouturl = $helper->getLogoutUrl($session, $next);



	// --------------------------
	// -------- COMMENTS --------
	// -------------------------- 
		// $request = new FacebookRequest(
		//     $session,
		//     'GET',
		// 	'/10152836802173445/comments'
		// );
		// $response = $request->execute();
		// $graphObject = $response->getGraphObject()->asArray();

	}
}








