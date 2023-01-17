<?php

require_once('static/include/authCheck.php');
require_once('model/fetchFromInflux.php');

//----- Création du contenu -----

	$dataTable = '<table>';
	$dataTable .= '<tr>';
	$dataTable .= '<th class="start">Nom</th>';
	$dataTable .= '<th class="numberCell">Dernier relevé</th>';
	$dataTable .= '<th class="numberCell">Consomation moyenne sur la dernière heure</tr>';
	$dataTable .= '</tr>';
	
	$backBt = '<tr class="changeHoverd" id="back">';
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
		foreach ($menu as $key => $value) {
			if($value == 'WIP') { continue; } // passe si cette partie est en construction
			
			$simul = false;
			$lastInsertTotal = 0;
			$tmp = adaptPointSerie(getLastInsert($value['requete']), $value['requete'], '');
			$lastTime = $tmp[0]['time'];
			foreach ($tmp as $tmpv) {
				$lastInsertTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['time']<$lastTime) {
					$lastTime = $tmpv['time'];
				}
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal = 0;
			$tmp = adaptPointSerie(getLastHourMean($value['requete']), $value['requete'], 'mean_');
			foreach ($tmp as $tmpv) {
				$lastHourMeanTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal /= count($tmp);

			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$key.'</td>';
			$dataTable .= '<td class="numberCell">'.$lastInsertTotal.(($simul)?'**':'').'</td>';
			$dataTable .= '<td class="numberCell">'.round($lastHourMeanTotal, 3).(($simul)?'**':'').'</td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.linkbase.'&bat='.$key.'"},';

			$i++;
		}

	} elseif ($dataToDisplay == batLVL) {
		//On affiche les étages d'un batiment
		$i=0;
		$dataTable .= $backBt;
		$diplayPath .= $_GET['bat'].'/';
		foreach ($menu[$_GET['bat']]['etages'] as $key => $value) {
			if($value == 'WIP') { continue; } // passe si cette partie est en construction

			$simul = false;
			$lastInsertTotal = 0;
			$tmp = adaptPointSerie(getLastInsert($value['requete']), $value['requete'], '');
			$lastTime = $tmp[0]['time'];
			foreach ($tmp as $tmpv) {
				$lastInsertTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['time']<$lastTime) {
					$lastTime = $tmpv['time'];
				}
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal = 0;
			$tmp = adaptPointSerie(getLastHourMean($value['requete']), $value['requete'], 'mean_');
			foreach ($tmp as $tmpv) {
				$lastHourMeanTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal /= count($tmp);

			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$key.'</td>';
			$dataTable .= '<td class="numberCell">'.$lastInsertTotal.(($simul)?'**':'').'</td>';
			$dataTable .= '<td class="numberCell">'.round($lastHourMeanTotal, 3).(($simul)?'**':'').'</td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.linkbase.'&bat='.$_GET['bat'].'&etg='.$key.'"},';

			$i++;
		}

	} else {
		//On affiche les salles d'un etage
		$i=0;
		$dataTable .= $backBt;
		$diplayPath .= $_GET['bat'].'/'.$_GET['etg'].'/';
		foreach ($menu[$_GET['bat']]['etages'][$_GET['etg']]['salles'] as $key => $value) {
			if(array_key_exists('WIP', $value)) { continue; } // passe si cette partie est en construction

			$simul = false;
			$lastInsertTotal = 0;
			$tmp = adaptPointSerie(getLastInsert($value['nom']), $value['nom'], '');
			$lastTime = $tmp[0]['time'];
			foreach ($tmp as $tmpv) {
				$lastInsertTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['time']<$lastTime) {
					$lastTime = $tmpv['time'];
				}
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal = 0;
			$tmp = adaptPointSerie(getLastHourMean($value['nom']), $value['nom'], 'mean_');
			foreach ($tmp as $tmpv) {
				$lastHourMeanTotal += $tmpv['sum_positive_active_energy_Wh'];
				if ($tmpv['dataOrigin'] == 'simulation') {
					$simul = true;
				}
			}
			$lastHourMeanTotal /= 1;

			$dataTable .= '<tr class="changeHoverd" id="row'.$i.'">';
			$dataTable .= '<td class="start">'.$value['nom'].'</td>';
			$dataTable .= '<td class="numberCell">'.$lastInsertTotal.(($simul)?'**':'').'</td>';
			$dataTable .= '<td class="numberCell">'.round($lastHourMeanTotal, 3).(($simul)?'**':'').'</td>';
			$dataTable .= '</tr>';

			$jsRows .= '{"idRow":"row'.$i.'","link":"'.grafanaLink.$value['nom'].'"},';
			$jsBackLink .= '&bat='.$_GET['bat'];

			$i++;
		}

	}

	$dataTable .= '</table>';

	require('vues/vTab.php');