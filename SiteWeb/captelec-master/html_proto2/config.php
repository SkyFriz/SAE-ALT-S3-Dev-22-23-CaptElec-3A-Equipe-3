<?php
/*
Information sur la base pour aller chercher des donnees
*/
$dbName = 'CaptElec';
$dbPort = 8086;
$dbHost = '127.0.0.1';
$dbUsername = 'admin';
$dbPapassword = 'admin';

/* 
donne le domaine et le chemin vers le repertoire racine du site 
MODIFIER AVEC PRECOTION
*/
$currentURLRoute = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$currentURLRoute .= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$rootURL = str_replace(['index', 'auth', '.php/'], '', explode('?', $currentURLRoute)[0]);
$rootURL = str_replace(['.php/', '.php'], '', $rootURL);
$grafanaRoomPage = 'http://captelec.iut-blagnac.fr:3000/d/Z1v-Sk57k/consulter-une-salle?orgId=1&refresh=10s&var-Salle=';

/*
*/
$themes = [
    "Clair-bleu" => [
        'bg' => '#c0d3ff',
        'fg' => '#1731e9',
        'border' => '#0000f7',
        'headerBg' => '#31a2ea',
        'sideMenuBG' => '#bec6f7',
        'fill' => 'rgb(242, 215, 5)',
        'stroke' => 'rgb(180, 82, 0)',
        'strokehighlight' => 'rgb(50, 0, 0)',
        'fillclickable' => 'rgb(242, 215, 5)',
        'fillhighlight' => 'rgb(255, 41, 41)',
        'strokeclickable' => 'rgb(180, 82, 0)',
        'highlightTxtBg' => 'rgba(0, 33, 255, 0.15)',
        'gradient' => [
            "min" => [
                'R' => "0",
                'V' => "255",
                'B' => "0",
            ],
            "max" => [
                'R' => "255",
                'V' => "0",
                'B' => "0",
            ],
            "default" => "rgb(50, 50, 50)"
        ]
    ],
    "Sombre" => [
        'bg' => '#111217',
        'fg' => '#ccccdc',
        'headerBg' => '#0a0b0d',
        'sideMenuBG' => 'black',
        'border' => 'whitesmoke',
        'stroke' => 'rgb(0, 26, 255)',
        'fill' => 'rgb(183, 232, 247)',
        'strokehighlight' => 'rgb(56, 0, 102)',
        'strokeclickable' => 'rgb(0, 26, 255)',
        'fillclickable' => 'rgb(183, 232, 247)',
        'fillhighlight' => 'rgb(247, 156, 239)',
        'highlightTxtBg' => 'rgba(255, 255, 255, 0.12)',
        'gradient' => [
            "min" => [
                'R' => "0",
                'V' => "255",
                'B' => "0",
            ],
            "max" => [
                'R' => "255",
                'V' => "0",
                'B' => "0",
            ],
            "default" => "rgb(250, 250, 250)"
        ]
    ],
    "Matrix-flat" => [
        'fg' => 'lime',
        'bg' => 'black',
        'stroke' => 'lime',
        'border' => 'lime',
        'headerBg' => 'black',
        'sideMenuBG' => 'black',
        'fill' => 'rgb(0, 0, 0)',
        'strokeclickable' => 'lime',
        'strokehighlight' => 'lime',
        'fillhighlight' => 'darkgreen',
        'fillclickable' => 'rgb(0, 0, 0)',
        'highlightTxtBg' => 'rgba(0, 255, 0, 0.12)',
        'gradient' => [
            "min" => [
                'R' => "0",
                'V' => "255",
                'B' => "0",
            ],
            "max" => [
                'R' => "255",
                'V' => "0",
                'B' => "0",
            ],
            "default" => "rgba(0, 0, 0, 0)"
        ]
    ]
];


/* Ici la liste des attributs GET que l'on peut attendre dans une url */
$urlAttr = [];
$urlAttr['atRoute'] = 'route'; //contient le nom de la page demandée
$urlAttr['atBatiment'] = 'bat'; //contient le batiment demandé
$urlAttr['atEtage'] = 'etg'; //contient l'étage demandé

/* Ici la liste des routes recevables sur atRoute */
$routes = [];
$routes['rtSett'] = 'sett'; //contient la chaine identifiant la route vers la page de settings
$routes['rtMenu'] = 'menu'; //contient la chaine identifiant la route vers la page des menus
$routes['rtMode'] = 'mode'; //contient la chaine identifiant la route vers les modeles
$routes['rtDeco'] = 'deco'; //contient la chaine identifiant la route vers la page de déconnexion

/*
Prépare les liens utiliés dans le menu de navigation
*/
$navLinks = '"btNavig" : "'.$rootURL.'index.php/?route='.$routes['rtMenu'].'",';
$navLinks .= '"btParam" : "'.$rootURL.'index.php/?route='.$routes['rtSett'].'",';
$navLinks .= '"btDeco" : "'.$rootURL.'index.php/?route='.$routes['rtDeco'].'",';

/* Ici les noms des cookies utilisés pour conserver les settings perso et leurs valeurs possibles pour les alternatives
    Dans le cas des alternatives on spécifie aussi une clause default qui donne la valeur par défaut de création du cookie
*/
$cookieNames = [];
$cookieNames['menuDisplay'] = [
    'default' => 'tab',
    'tab' => 'displayTab',
    'svg' => 'displaySVG'
];
$cookieNames['themUsed'] = ['default' => array_key_first($themes)];
foreach ($themes as $key => $value) {
    $cookieNames['themUsed'][$key] = $key;
}

/* Ici on détermine en seconde le temps de vie qui sera attribué aux nouveaux cookies */
$cookieLifeTime = 3600*24*30;

/* Ici on définit le nom du fichier contenant le svg de l'IUT enentier */
$svgIUT = 'IUT.svg';

/* 
*/
$menu = [
    'Batiment_A-admin' => 'WIP',
    'Batiment_A-bibli' => 'WIP',
    'Batiment_C-locTech' => 'WIP',
    'Batiment_E' => 'WIP',
    'Maison_Intelligente' => 'WIP',

    'Batiment_B' => [
        'id' => 'bat_B',
        'image' => 'bat_B.svg',
        'requete' => '/B_[0-9abc]*/',

        'etages' => [
            'Rez de chaussée' => [
                'id' => 'rdc',
                'image' => 'rdc_B.svg',
                'requete' => '/B_0[0-9abc]*/',

                'salles' => [
                    'b001' => ['nom' => 'B_001', 'WIP' => true],
                    'b002' => ['nom' => 'B_002', 'WIP' => true],
                    'b003' => ['nom' => 'B_003', 'WIP' => true],
                    'b004' => ['nom' => 'B_004', 'WIP' => true],
                    'b005' => ['nom' => 'B_005', 'WIP' => true],
                    'b006' => ['nom' => 'B_006', 'WIP' => true],
                    'b007' => ['nom' => 'B_007', 'range' => ['min' => 20, 'max' => 4000]],
                    'b008' => ['nom' => 'B_008', 'WIP' => true],
                    'b009' => ['nom' => 'B_009', 'WIP' => true],
                    'b010' => ['nom' => 'B_010', 'WIP' => true],
                    'magasin' => ['nom' => 'Magasin', 'WIP' => true],
                    'cafet' => ['nom' => 'Caféteria', 'WIP' => true],
                    'san' => ['nom' => 'Sanitaires', 'WIP' => true],
                    'rgt' => ['nom' => 'Rangement', 'WIP' => true]
                ]
            ],
            'Premier Etage' => [
                'id' => 'et1',
                'image' => 'et1_B.svg',
                'requete' => '/B_1[0-9abc]*/',

                'salles' => [
                    'b101' => ['nom' => 'B_101', 'range' => ['min' => 20, 'max' => 3000]],
                    'b102' => ['nom' => 'B_102', 'range' => ['min' => 20, 'max' => 3000]],
                    'b103' => ['nom' => 'B_103', 'range' => ['min' => 20, 'max' => 3000]],
                    'b104' => ['nom' => 'B_104', 'range' => ['min' => 20, 'max' => 3000]],
                    'b105' => ['nom' => 'B_105', 'range' => ['min' => 20, 'max' => 3000]],
                    'b106' => ['nom' => 'B_106', 'range' => ['min' => 20, 'max' => 3000]],
                    'b107' => ['nom' => 'B_107', 'WIP' => true],
                    'b108' => ['nom' => 'B_108', 'WIP' => true],
                    'b109' => ['nom' => 'B_109', 'WIP' => true],
                    'b109b' => ['nom' => 'B_109b', 'WIP' => true],
                    'b110' => ['nom' => 'B_110', 'WIP' => true],
                    'b111' => ['nom' => 'B_111', 'WIP' => true],
                    'b112' => ['nom' => 'B_112', 'WIP' => true],
                    'b112b' => ['nom' => 'B_112b', 'WIP' => true],
                    'b113' => ['nom' => 'B_113', 'WIP' => true],
                    'b115' => ['nom' => 'B_115', 'WIP' => true],
                    'b116a' => ['nom' => 'B_116a', 'WIP' => true],
                    'b116b' => ['nom' => 'B_116b', 'WIP' => true],
                    'sousStation' => ['nom' => 'Sous-Station', 'WIP' => true],
                    'san' => ['nom' => 'Sanitaires', 'WIP' => true],
                    'rgt' => ['nom' => 'Rangement', 'WIP' => true]
                ]
            ],
            'Second Etage' => [
                'id' => 'et2',
                'image' => 'et2_B.svg',
                'requete' => '/B_2[0-9abc]*/',

                'salles' => [
                    'b201' => ['nom' => 'B_201', 'WIP' => true],
                    'b202' => ['nom' => 'B_202', 'WIP' => true],
                    'b203' => ['nom' => 'B_203', 'WIP' => true],
                    'b204' => ['nom' => 'B_204', 'WIP' => true],
                    'b205' => ['nom' => 'B_205', 'WIP' => true],
                    'b206' => ['nom' => 'B_206', 'WIP' => true],
                    'b207' => ['nom' => 'B_207', 'WIP' => true],
                    'b208' => ['nom' => 'B_208', 'WIP' => true],
                    'b209' => ['nom' => 'B_209', 'WIP' => true],
                    'b210' => ['nom' => 'B_210', 'WIP' => true],
                    'b211' => ['nom' => 'B_211', 'WIP' => true],
                    'b212a' => ['nom' => 'B_212a', 'WIP' => true],
                    'b212b' => ['nom' => 'B_212b', 'WIP' => true],
                    'b213' => ['nom' => 'B_213', 'WIP' => true],
                    'b214' => ['nom' => 'B_214', 'WIP' => true],
                    'b215' => ['nom' => 'B_215', 'WIP' => true],
                    'b216' => ['nom' => 'B_216', 'WIP' => true],
                    'b219' => ['nom' => 'B_219', 'range' => ['min' => 20, 'max' => 5000]],
                    'b220' => ['nom' => 'B_220', 'WIP' => true],
                    'b221' => ['nom' => 'B_221', 'WIP' => true],
                    'b222' => ['nom' => 'B_222', 'WIP' => true],
                    'b223' => ['nom' => 'B_223', 'WIP' => true],
                    'b224' => ['nom' => 'B_224', 'WIP' => true],
                    'b225' => ['nom' => 'B_225', 'WIP' => true],
                    'b226' => ['nom' => 'B_226', 'WIP' => true],
                    'b227' => ['nom' => 'B_227', 'WIP' => true],
                    'b228a' => ['nom' => 'B_228a', 'WIP' => true],
                    'b228b' => ['nom' => 'B_228b', 'WIP' => true],
                    'b228c' => ['nom' => 'B_228c', 'WIP' => true],
                    'b229' => ['nom' => 'B_229', 'WIP' => true],
                    'b230' => ['nom' => 'B_230', 'WIP' => true],
                    'b231' => ['nom' => 'B_231', 'WIP' => true],
                    'b232' => ['nom' => 'B_232', 'WIP' => true],
                    'b233' => ['nom' => 'B_233', 'WIP' => true],
                    'b234' => ['nom' => 'B_234', 'WIP' => true],
                    'b235a' => ['nom' => 'B_235', 'WIP' => true],
                    'b235b' => ['nom' => 'B_235', 'WIP' => true],
                    'san' => ['nom' => 'Sanitaires', 'WIP' => true],
                    'rgt' => ['nom' => 'Rangement', 'WIP' => true],
                    'balcon' => ['nom' => 'Balcon', 'WIP' => true],
                ]
            ]
        ]
    ],
];

