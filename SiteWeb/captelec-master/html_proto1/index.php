<?php

//----- Imports et constantes -----
	$jsonString = file_get_contents('menuData.json');
	$jsonData = json_decode($jsonString, true);

	define('rootLVL', 0);
	define('batLVL', 1);
	define('floorLVL', 2);

	define('linkbase', 'http://localhost/');
	define('grafanaLink', 'http://127.0.0.1:3000/d/Z1v-Sk57k/consulter-une-salle?orgId=1&refresh=10s&var-Salle=');

	//echo '<pre>'; print_r($jsonData); echo '</pre>';

	$errors = array(
		'Le batiment en paramètre n\'existe pas !',
		'L\'etage en paramètre n\'existe pas !',
	);

//----- Gestion des paramètres URL -----
	// Si on a un batiment en paramètre
	if (!empty($_GET['bat'])) {

		// Si ce batiment existe
		if (array_key_exists($_GET['bat'], $jsonData)) {

			// Si on a un étage en paramètre
			if (!empty($_GET['etg'])) {

				// Si cet étage existe dans le batiment
				if (array_key_exists($_GET['etg'], $jsonData[$_GET['bat']]['etages'])) {
					
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

//----- Création du contenu -----

	$dataTable = '<table>';
	$dataTable .= '<tr>';
	$dataTable .= '<th class="start">Nom</th>';
	$dataTable .= '<th class="numberCell">Dernier relevé</th>';
	$dataTable .= '<th class="numberCell">Consomation moyenne sur la dernière heure</tr>';
	$dataTable .= '</tr>';
	
	$backBt = '<tr class="changeHoverd" id="back'.$i.'">';
	$backBt .= '<td class="start">Retour</td>';
	$backBt .= '<td></td>';
	$backBt .= '<td></td>';
	$backBt .= '</tr>';

	$diplayPath = '/';

	$jsRows = '';
	$jsBackLink = linkbase;

	if ($dataToDisplay == rootLVL) {
		//On affiche les batiments
		$i=0;
		foreach ($jsonData as $key => $value) {
			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$key.'</td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.linkbase.'?bat='.$key.'"},';

			$i++;
		}

	} elseif ($dataToDisplay == batLVL) {
		//On affiche les étages d'un batiment
		$i=0;
		$dataTable .= $backBt;
		$diplayPath .= $_GET['bat'].'/';
		foreach ($jsonData[$_GET['bat']]['etages'] as $key => $value) {
			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$key.'</td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.linkbase.'?bat='.$_GET['bat'].'&etg='.$key.'"},';

			$i++;
		}

	} else {
		//On affiche les salles d'un etage
		$i=0;
		$dataTable .= $backBt;
		$diplayPath .= $_GET['bat'].'/'.$_GET['etg'].'/';
		foreach ($jsonData[$_GET['bat']]['etages'][$_GET['etg']]['salles'] as $key => $value) {
			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$value.'</td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '<td class="numberCell"></td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.grafanaLink.$value.'"},';
			$jsBackLink .= '?bat='.$_GET['bat'];

			$i++;
		}

	}


	$dataTable .= '</table>';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CaptElec-Home</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>CaptElec<span style="font-size: 1rem;">(v1)</span></h1>
	</header>
	<p id="pathDisplay"><?=$diplayPath?></p>
	<div id="conteneur">
		<div>
			<?=$dataTable;?>
			<p>*(toutes les mesures sont en watt)</p>
		</div>
	</div>
	<script>
		const rows = {
			"data" : [<?=$jsRows?>],
			"GoBackLink" : "<?=$jsBackLink?>"
		};
	</script>
	<script src="script.js"></script>
</body>
</html>