<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>test</title>
    </head>
    <body>
        <h1>test</h1>
        <p>Batiment IUT</p>
        <?php
            $svg_iut_url= "batimentIUT.svg";
            $svg_iut_content= file_get_contents($svg_iut_url);
            echo $svg_iut_content;
        ?>
        <p>Batiment B</p>
        <?php
            $svg_batB_url= "batimentB.svg";
            $svg_batB_content= file_get_contents($svg_batB_url);
            echo $svg_batB_content;
        ?>
        <p>RDC</p>
        <?php
            $svg_rdc_url= "rdc.svg";
            $svg_rdc_content= file_get_contents($svg_rdc_url);
            echo $svg_rdc_content;
        ?>
        <p>1 étage</p>
        <?php
            $svg_1etage_url= "1etage.svg";
            $svg_1etage_content= file_get_contents($svg_1etage_url);
            echo $svg_1etage_content;
        ?>
        <p>2 étage</p>
        <?php
            $svg_2etage_url= "2etage.svg";
            $svg_2etage_content= file_get_contents($svg_2etage_url);
            echo $svg_2etage_content;
        ?>
        <input type="button" value="Retour" onclick="window.location.href='./../index.php'" />
    </body>
</html>