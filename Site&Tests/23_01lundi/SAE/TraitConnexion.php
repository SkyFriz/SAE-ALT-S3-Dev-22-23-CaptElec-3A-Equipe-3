<?php
	session_start();
	// Le formulaire a été soumis
	if (isset($_POST['Envoyer']) && isset($_POST['login']) && isset($_POST['motPasse']) 
								&& $_POST['login']=='admin' && $_POST['motPasse']=='admin' ) {
		$_SESSION['identifie']='OK';
		// si l'utilisateur a cliqué sur la case à cocher "se souvenir de moi" alors on lui envoie un cookie 
		// qui permettra un pré-remplissage du champ login dans le formulaire de connexion
		if (isset($_POST['cb_souvenirMoi'])) {
			$valCookie=$_POST['login'];
			// on met 60 sec de vie pour ce cookie afin de tester sa disparation
			setcookie('cookIdent', $valCookie, time()+60);
		}
		header('location: index.php');
		exit();
	}
	// le formulaire n'a pas été soumis ou les identifiants sont vides ou incorrects
	else {
		header('location: FormConnexion.php?msgErreur=Tentative d\'acces interdite');
		exit();
	}
?>
