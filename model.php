<?php 

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;


if(isset($_POST['newsl_mail'])) {


	$req = $bdd->prepare('SELECT mail FROM newsletter WHERE mail = :mail');
	$req->execute(array('mail' => $_POST['newsl_mail']));
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
		
		header('Location: index.php');

	}
	
	// ---------------------------------------------------------
	// ---------------------- USER INFO ------------------------
	// Récupération des infos user via SDK FB, et update en BDD
	// ---------------------------------------------------------
	else {
		$user_profile = (new \Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(Facebook\GraphUser::className());

		$name = $user_profile->getName();
		$mail = $user_profile->getProperty('email');
		$genre = $user_profile->getProperty('gender');
		$id_fb = $user_profile->getProperty('id');

		  
		$req2 = $bdd->prepare('SELECT id_fb, vote FROM users WHERE id_fb = :fb');
		$req2->execute((array('fb' => $id_fb)));
		$result = $req2->fetch();
		$vote = $result["vote"];

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

		// echo $result["nom"]." ".$result["prenom"];


	// -------------------------------
	// ------ LOGOUT SESSION FB ------
	// -------------------------------
	$logouturl = $helper->getLogoutUrl($session, $next);





	// -------------------------------------------------------------
	// ------ EVENT (Récupére les events à venir et passé !)  ------
	// ------------------------------------------------------------- 
		$request_events = (new FacebookRequest(
			$session,
			'GET',
			'/SensioLabs/events?fields=id,name,description,start_time&since=2000-01-01'
		))->execute()->getGraphObject()->asArray();

		$events = $request_events['data'];



	// --------------------------
	// -------- COMMENTS --------
	// -------------------------- 
		$request = new FacebookRequest(
		    $session,
		    'GET',
			'/10152836802173445/comments'
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject()->asArray();

	}
}








