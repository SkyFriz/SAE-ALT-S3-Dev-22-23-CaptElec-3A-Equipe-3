<?php
require_once('static/include/authCheck.php');
require_once('config.php');
require_once('static/include/cookieCorrect.php');

//---- Routage -----
    if (!empty($_GET[$urlAttr['atRoute']])) {

        switch ($_GET[$urlAttr['atRoute']]) {
            // Acces aux settings
            case $routes['rtSett']:
                require('controleurs/ctrlSettingsForm.php');
                break;

            // Acces aux menus
            case $routes['rtMenu']:
                require('controleurs/ctrlMenu.php');
                break;

            // deconnexion
            case $routes['rtDeco']:
                session_unset();
                header('location:'.$rootURL.'auth.php');
                break;

            case $routes['rtMode']:
                break;

            // sinon on revien sur les menus si on sait pas
            default:
                require('controleurs/ctrlMenu.php');
        }

    } else {
        // si aucune route n'est donnee
        header('location:'.$rootURL.'index.php/?'.$urlAttr['atRoute'].'='.$routes['rtMenu']);
    }