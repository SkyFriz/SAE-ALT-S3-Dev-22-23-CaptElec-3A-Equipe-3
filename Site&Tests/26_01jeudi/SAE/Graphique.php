<?php

ob_start();
include 'index.php';
ob_end_clean();



echo "Study " . $_GET['Salle'];

echo $_COOKIE["type"];

echo "<iframe src="."http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=".$_GET['Salle']."&var-Type=".$_COOKIE["type"]."&from=now-80h&to=now&refresh=5s&panelId=4 "."width="."450 "."height="."200 "."frameborder="."0"."></iframe>";


?>



<iframe src="http://51.38.52.224:3000/d-solo/yzPzqDo4z/sae?orgId=1&var-Salle=B002&var-Type=temperature&from=now-80h&to=now&refresh=5s&panelId=8" width="450" height="200" frameborder="0"></iframe>