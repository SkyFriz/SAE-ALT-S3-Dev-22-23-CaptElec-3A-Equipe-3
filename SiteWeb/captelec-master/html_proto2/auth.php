<?php
session_start();
require_once('config.php');
if (!empty($_SESSION['log'])) {
    header('location:'.$rootURL.'index.php/?'.$urlAttr['atRoute'].'='.$routes['rtMenu']);
}

require_once('static/include/cookieCorrect.php');


$json = file_get_contents('sensible/.mdp.json');
$jsonData = json_decode($json, true);
$salt = file_get_contents('sensible/.salt');

if(isset($_POST['sub'])) { // Si on vient d'un formulaire envoyé
    if(!empty($_POST['psw']) && !empty($_POST['log'])) { // Si le mdp et le login sont remplis
    
        // on passe le login et mot de passe dans la fonction htmlentities
        $_POST['log'] = htmlentities($_POST['log']);
        $_POST['psw'] = htmlentities($_POST['psw']);

        if (key_exists($_POST['log'], $jsonData)) {// validation login
            $attempt = crypt($_POST['psw'], $salt);
            if (hash_equals($attempt, $jsonData[$_POST['log']])) { // validation mdp

                //On enregistre les données dans la session
                $_SESSION['log'] = $_POST['log'];

                header('location:'.$rootURL.'index.php/?'.$urlAttr['atRoute'].'='.$routes['rtMenu']);
            } else {
                header('location:'.$rootURL.'auth.php/?err=1'); //On redirige l'utilisateur sur la page de connexion avec une erreur
            }
        } else { // Si le login est faux
            header('location:'.$rootURL.'auth.php/?err=1'); //On redirige l'utilisateur sur la page de connexion avec une erreur

        }
    } else { // On a pas de log ou de mdp
        header('location:'.$rootURL.'auth.php/?err=0'); //On redirige l'utilisateur sur la page de connexion avec une erreur
    }
}

// Si il y a un code d'erreur dans l'URL on choisi le message d'erreur correspondant
if (isset($_GET['err'])) {
    switch ($_GET['err']) {
        case 0:
            $msgErr = 'Login et mot de passe ne doivent pas êtres vides !';
            break;
        case 1:
            $msgErr = 'Login ou mot de passe invalide !';
            break;
        case 2:
            $msgErr = 'Vous devez d\'abord être authentifié pour accéder au reste du site !';
            break;
        default:
            $msgErr = 'Code erreur inconnu !';
            break;
    }
}

require('vues/vAuth.php');