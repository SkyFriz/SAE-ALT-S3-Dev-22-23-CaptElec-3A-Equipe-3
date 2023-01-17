<?php
//---- Vérifiacation et correction des cookies ----
/* 
On vérifie que tous les cookies dont nous avons besoin existent et on des valeurs
admissibles si ce n'est pas le cas on les crées avec la valeur par défaut précue
*/

    $mustReload = false;
    foreach ($cookieNames as $cookie => $value) {
        if (!isset($_COOKIE[$cookie])) {
            setcookie($cookie, $cookieNames[$cookie][$cookieNames[$cookie]['default']], time()+$cookieLifeTime, '/');
            $mustReload = true;
        } else {
            if (!in_array($_COOKIE[$cookie], $cookieNames[$cookie])) {
                setcookie($cookie, $cookieNames[$cookie][$cookieNames[$cookie]['default']], time()+$cookieLifeTime, '/');
                $mustReload = true;
            }
        }
    }

    if ($mustReload) {
        header('location:'.$currentURLRoute); //redirection pour que les cookies soit pris en compte
    }