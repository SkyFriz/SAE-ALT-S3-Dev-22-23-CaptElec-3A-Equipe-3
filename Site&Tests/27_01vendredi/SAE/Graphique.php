<?php
ob_start();
include 'index.php';
ob_end_clean();

if(!empty($_POST['temps'])){
    $temps=$_POST['temps'];
}
else{
    $temps=1;
}
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
        <div class="select1">
            <div class="formSelect">
                <form action="" method="post">
                    <label>Durée :</label>
                    <select name="temps">
                        <option value="1">1h</option>
                        <option value="3">3h</option>
                        <option value="6">6h</option>
                        <option value="12">12h</option>
                        <option value="24">1j</option>
                        <option value="48">2j</option>
                        <option value="168">7j</option>
                    </select><br>
                    <input type="submit" name="Valider" value="Valider">
                </form>
            </div>
            <div class="typeSelect">
                <?php
                    if(!empty($_POST['temps'])){
                        echo 'Sélection : '.$_POST['temps'].'h';
                    }
                    else{
                        echo 'Sélection :1h';
                    }
                ?>
            </div>
        </div>
        <div class="graphique">
            <?php
                echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-".$temps."h&to=now&refresh=5s&panelId=4 "."width="."900 "."height="."400 "."frameborder="."0"."></iframe>";
                echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-".$temps."h&to=now&refresh=5s&panelId=6 "."width="."900 "."height="."400 "."frameborder="."0"."></iframe>";
                echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-".$temps."h&to=now&refresh=5s&panelId=10 "."width="."900 "."height="."400 "."frameborder="."0"."></iframe>";
            ?>
            <iframe src="http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=B002&var-Type=temperature&from=now-24h&to=now&refresh=5s&panelId=8" width="900" height="400" frameborder="0"></iframe>
            <iframe src="http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=B002&var-Type=temperature&from=now-24h&to=now&refresh=5s&panelId=12" width="900" height="400" frameborder="0"></iframe>
            
        </div>
    </body>
</html>