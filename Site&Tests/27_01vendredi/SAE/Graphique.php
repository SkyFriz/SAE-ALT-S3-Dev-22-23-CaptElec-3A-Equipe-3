<?php
ob_start();
include 'index.php';
ob_end_clean();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css"/>
        <?php
            include 'include/head.php';
        ?>
    </head>
    <body>
        <div class="TG">
            <?php
                echo $_COOKIE["type"];
                echo " de la salle ";
                echo $_GET['Salle'];
            ?>
        </div>
        <div class="graphique">
            <?php
                echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-24h&to=now&refresh=5s&panelId=4 "."width="."900 "."height="."400 "."frameborder="."0"."></iframe>";
                echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-24h&to=now&refresh=5s&panelId=6 "."width="."900 "."height="."400 "."frameborder="."0"."></iframe>";
            ?>
            <iframe src="http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=B002&var-Type=temperature&from=now-24h&to=now&refresh=5s&panelId=8" width="900" height="400" frameborder="0"></iframe>

            
        </div>
    </body>
</html>