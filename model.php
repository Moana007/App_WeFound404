<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;


if (isset($session)) {

// ---------------------------------------------------------
// ---------------------- USER INFO ------------------------
// Récupération des infos user via SDK FB, et update en BDD
// ---------------------------------------------------------
	$user_profile = (new \Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(Facebook\GraphUser::className());

	$name = $user_profile->getName();
	$mail = $user_profile->getProperty('email');
	$genre = $user_profile->getProperty('gender');
	$id_fb = $user_profile->getProperty('id');

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=taches;charset=utf8', 'root', '');
	} catch(Exception $e){
			die('Erreur : '.$e->getMessage());
	}
	  
	$req2 = $bdd->prepare('SELECT id_fb FROM users WHERE id_fb = :fb');
	$req2->execute((array('fb' => $id_fb)));
	$result = $req2->fetch();

	if($result["id_fb"] != $id_fb){
		$req = $bdd->prepare('INSERT INTO users(Nom, mail, genre, id_fb) VALUES(:name, :mail, :genre, :id_fb)');
		$req->execute(array(
			'name' => $name,
			'mail' => $mail,
			'genre' => $genre,
			'id_fb' => $id_fb
		));
	}


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

if(isset($_POST['newsl_mail'])) {

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=taches;charset=utf8', 'root', '');
	} catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('SELECT mail FROM newsletter WHERE mail = :mail');
	$req->execute(array('mail' => $_POST['newsl_mail']));
	$result = $req->fetch();

	if($result["mail"] != $_POST['newsl_mail']){
		$req = $bdd->prepare('INSERT INTO newsletter(mail) VALUES(:mail)');
		$req->execute(array('mail' => $_POST['newsl_mail']));
		//header(location:"model.php")
		sleep(3);
		header('Location: index.php'); // FAIRE REQUETE ET REDIRECT EN AJAX
	}
	else { echo "vous etes deja inscrit";}

}








