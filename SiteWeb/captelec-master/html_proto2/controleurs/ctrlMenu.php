<?php

require_once('static/include/authCheck.php');

//----- constantes -----

	define('rootLVL', 0);
	define('batLVL', 1);
	define('floorLVL', 2);

    //echo '<pre>'; print_r(explode('&', $currentURLRoute)); echo '</pre>';

	define('linkbase', explode('&', $currentURLRoute)[0]);
	define('grafanaLink', $grafanaRoomPage);

	$errors = array(
		'Le batiment en paramètre n\'existe pas !',
		'L\'etage en paramètre n\'existe pas !',
	);

//----- Gestion des paramètres URL -----
	// Si on a un batiment en paramètre
	if (!empty($_GET['bat'])) {

		// Si ce batiment existe
		if (array_key_exists($_GET['bat'], $menu)) {

			// Si on a un étage en paramètre
			if (!empty($_GET['etg'])) {

				// Si cet étage existe dans le batiment
				if (array_key_exists($_GET['etg'], $menu[$_GET['bat']]['etages'])) {
					
					// Ici on a donc en paramètre un étage et un batiment valides
					$dataToDisplay = floorLVL;

				} else {
					// Ici on a donc en paramètre un batiment valide et un étage invalide
					$err = 1;
					$dataToDisplay = batLVL;
				}
			} else {
				// Ici on a donc en paramètre un batiment valide
				$dataToDisplay = batLVL;
			}
		} else {
			// Ici on a donc en paramètre un batiment invlalide
			$err = 0;
			$dataToDisplay = rootLVL;
		}
	} else {
		// Ici on a donc aucun paramètre
		$dataToDisplay = rootLVL;
	}
	// NB: On ignore le cas ou on a un étage et pas de batiment


//----- Appel du controleur compétent -----
    if ($_COOKIE['menuDisplay'] == $cookieNames['menuDisplay']['tab']) {
        require('ctrlTab.php');
    } elseif ($_COOKIE['menuDisplay'] == $cookieNames['menuDisplay']['svg']) {
        require('ctrlSVG.php');
    }