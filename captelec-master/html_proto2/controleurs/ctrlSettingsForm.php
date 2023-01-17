<?php

require_once('static/include/authCheck.php');

$champs = ['menuDisplay', 'theme', 'sub'];
$champsValides = true;
foreach ($champs as $key => $value) {
    if(empty($_POST[$value])) {
        $champsValides = false;
    }
    
}
$currentValues = [
    'menuDisplay' => $_COOKIE['menuDisplay'],
    'themUsed' => $_COOKIE['themUsed'],
];


if ($champsValides) {

    //navigation
    if (in_array($_POST['menuDisplay'], $cookieNames['menuDisplay'])) {
        setcookie('menuDisplay', $_POST['menuDisplay'], time()+$cookieLifeTime, '/');
        $currentValues['menuDisplay'] = $_POST['menuDisplay'];
    }

    //theme
    if (in_array($_POST['theme'], $cookieNames['themUsed'])) {
        setcookie('themUsed', $_POST['theme'], time()+$cookieLifeTime, '/');
        $currentValues['themUsed'] = $_POST['theme'];
        header('location:'.$currentURLRoute); //redirection pour que le theme soit appliqué
    }
}

require('vues/vSettings.php');