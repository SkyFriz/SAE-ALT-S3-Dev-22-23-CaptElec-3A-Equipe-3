<?php

require_once('static/include/authCheck.php');
require_once('model/fetchFromInflux.php');

//----- Création du contenu -----

	$etg = false;

    $listMenu = '<ul>';

	$diplayPath = '/';

    $backBt = '<li class="changeHoverd" id="back">Retour</li>';

	$jsElements = '';
	$jsBackLink = linkbase;

	if ($dataToDisplay == rootLVL) {
		//On affiche les batiments
        $selectedSVG = $svgIUT;
		$i=0;
		foreach ($menu as $key => $value) {
			if($value == 'WIP') { continue; } // passe si cette partie est en construction
            
            $listMenu .= '<li class="changeHoverd" id="'.$value['id'].'_li'.'">'.$key.'</li>';

			$jsElements .= '{"idElem":"'.$value['id'].'","link":"'.linkbase.'&bat='.$key.'"},';

			$i++;
		}

	} elseif ($dataToDisplay == batLVL) {
		//On affiche les étages d'un batiment
        $selectedSVG = $menu[$_GET['bat']]['image'];
		$i=0;
		$listMenu .= $backBt;
		$diplayPath .= $_GET['bat'].'/';
		foreach ($menu[$_GET['bat']]['etages'] as $key => $value) {
			if($value == 'WIP') { continue; } // passe si cette partie est en construction
            $listMenu .= '<li class="changeHoverd" id="'.$value['id'].'_li'.'">'.$key.'</li>';

			$jsElements .= '{"idElem":"'.$value['id'].'","link":"'.linkbase.'&bat='.$_GET['bat'].'&etg='.$key.'"},';

			$i++;
		}

	} else {
		//On affiche les salles d'un etage
		$etg = true;
        $selectedSVG = $menu[$_GET['bat']]['etages'][$_GET['etg']]['image'];
		$i=0;
		$listMenu .= $backBt;
		$diplayPath .= $_GET['bat'].'/'.$_GET['etg'].'/';
		$jsBackLink .= '&bat='.$_GET['bat'];

		foreach ($menu[$_GET['bat']]['etages'][$_GET['etg']]['salles'] as $key => $value) {
			if(array_key_exists('WIP', $value)) { continue; } // passe si cette partie est en construction

			$simul = false;
			//var_dump();
			$lastInsert = adaptPoint(getLastInsert($value['nom'])[0]);
			
			if ($lastInsert['sum_positive_active_energy_Wh']<$value['range']['min']) {
				# code...
			} else {
				$gradient = $themes[$_COOKIE['themUsed']]['gradient'];
				$max = $value['range']['max'];
				$min = $value['range']['min'];

				$aR = ($gradient['max']['R']-$gradient['min']['R']) / ($max-$min);
				$aV = ($gradient['max']['V']-$gradient['min']['V']) / ($max-$min);
				$aB = ($gradient['max']['B']-$gradient['min']['B']) / ($max-$min);
				$bR = $gradient['max']['R']-($aR*$max);
				$bV = $gradient['max']['V']-($aV*$max);
				$bB = $gradient['max']['B']-($aB*$max);

				//echo $aR,' / ',$aV,' / ',$aB,' | ',$bR,' / ',$bV,' / ',$bB, ' / ', $lastInsert['sum_positive_active_energy_Wh'], '<br>';

				$R = ($aR * $lastInsert['sum_positive_active_energy_Wh']) + $bR;
				$V = ($aV * $lastInsert['sum_positive_active_energy_Wh']) + $bV;
				$B = ($aB * $lastInsert['sum_positive_active_energy_Wh']) + $bB;
				$color = 'rgb('.round($R).', '.round($V).', '.round($B).');';
			}


            $listMenu .= '<li class="changeHoverd" id="'.$key.'_li'.'">'.$value['nom'].'</li>';
			$jsElements .= '{"idElem":"'.$key.'","link":"'.grafanaLink.$value['nom'].'", "val":'.$lastInsert['sum_positive_active_energy_Wh'].', "color":"'.$color.'", "nom":"'.$value['nom'].'", "min":'.$value['range']['min'].', "max":'.$value['range']['max'].'},';

			$i++;
		}

	}

	$listMenu .= '</ul>';

	require('vues/vSVG.php');