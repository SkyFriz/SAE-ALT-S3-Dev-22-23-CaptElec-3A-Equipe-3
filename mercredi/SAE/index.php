<?php
    session_start(); // On démarre la session
    // On vérifie que l'utilisateur est bien connecté
    if (!isset($_SESSION['identifie']) OR isset($_SESSION['identifie'])!='OK') {
        header('location:connexion.php?msgErreur=');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="svg/style.css" />
        <title>Mon site</title>
    </head>
    <body>
        <?php

        ?>

        <h1>Mon site</h1>
        <h2>Menu navigation</h2>
        <form action="" method="POST">
            <label>RDC</label>
            <input type="submit" name="batiment" value="batimentB/rdc"><br>
            <label>1er étage</label>
            <input type="submit" name="batiment" value="batimentB/1etage"><br>
            <label>2ème étage</label>
            <input type="submit" name="batiment" value="batimentB/2etage"><br>
            <label>Batiment B</label>
            <input type="submit" name="batiment" value="batimentB"><br>
            <label>Batiment IUT</label>
            <input type="submit" name="batiment" value="batimentIUT"><br>
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                if(!empty($_POST['etage'])){
                    $svg_rdc_url= 'svg/'.$_POST['batiment'].'/'.$_POST['etage'].'.svg';
                $svg_rdc_content= file_get_contents($svg_rdc_url);
                echo $svg_rdc_content;
                }
                else{
                    $svg_rdc_url= 'svg/'.$_POST['batiment'].'.svg';
                    $svg_rdc_content= file_get_contents($svg_rdc_url);
                    echo $svg_rdc_content;
                }
            }
        ?> 

        <form action="" method="POST">
            <label></label>
            <select id="bat" name="batiment">
                <option value="batimentIUT">Tous</option>
                <option value="maisonInt">Maison intelligente</option>
                <option value="batAadministration">Batiment A (administration)</option>
                <option value="batAbibli">Batiment A (bibliothèque)</option>
                <option value="batimentB">Batiment B (G.I.M. & Info)</option>
                <option value="batimentC">Batiment C (Recherche) + Amphi1 + Local Technique</option>
                <option value="batimentE">Batiment E (R&T)</option>
            </select>
            <select id="niv" name="etage">
                <option></option>
                <option value="rdc">Rez de chaussé</option>
                <option value="1etage">1er étage</option>
                <option value="2etage">2ème étage</option>
            </select>
            <input type="submit" name="Rechercher">
        </form>

        <input type="button" value="Déconnexion" onclick="window.location.href='Deconnexion.php'" />
        <input type="button" value="test" onclick="window.location.href='svg/test.php'" />
    </body>
</html>