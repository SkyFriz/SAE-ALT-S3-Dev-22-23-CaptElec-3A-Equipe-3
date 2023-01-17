<?php
$salt = file_get_contents('.salt');



ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if(!empty($_POST['mdp']) && !empty($_POST['login'])) {
	$sipher = crypt($_POST['mdp'], $salt);
	$res = '"'.$_POST['login'].'" : "'.$sipher.'",';

} else {
	$res = '';
	$_POST['mdp'] = '';
	$_POST['login'] = '';
}

?>
<p style="border: 2px solid black;padding: 10px;"><?=$res?></p>
<form method="POST">
<input type="text" name="login" placeholder="login" value="<?=$_POST['login']?>">
<br>
<input type="text" name="mdp" placeholder="mdp" value="<?=$_POST['mdp']?>">
<br>
<input type="submit" value="générer">
</form>
