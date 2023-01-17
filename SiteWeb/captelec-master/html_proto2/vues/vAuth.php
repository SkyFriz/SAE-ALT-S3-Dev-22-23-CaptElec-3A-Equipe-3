<?php
    require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Identification</title>
    <style>
		<?php
            $hidenav = true;
			require_once('static/style/baseStyle.css.inc.php');
			require_once('static/style/authStyle.css.inc.php');
			require_once('static/style/loaderStyle.css.inc.php');
		?>
	</style>
</head>
<body>
    <?php require('static/include/header.php');?>
    
    <?php if(isset($msgErr)) {echo '<div class="error">Erreur : '.$msgErr.'</div>';} ?>

    <form method="POST" action="">
        <div>
            <label for="log">Login : </label><br>
            <input type="text" name="log" id="log" required><br>                
            <label for="psw">Mot de passe :</label><br>
            <input type="password" name="psw" id="psw" required><br>
            <div class="loader" id="loader-1" hidden></div><br>
            <input type="submit" name="sub" value="Connexion">
        </div>
    </form>


    <script>
        document.getElementsByTagName('form').item(0).addEventListener('submit', (e) => {
            document.getElementById('loader-1').toggleAttribute('hidden');
        });
    </script>

</body>
</html>