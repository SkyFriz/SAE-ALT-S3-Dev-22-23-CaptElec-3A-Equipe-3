<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>connexion</title>
    </head>
    <body>
	
    <?php
		if (isset($_GET['msgErreur'])) {
			echo "<h2>".$_GET['msgErreur']."</h2><BR>";
		}
		
		echo "<form method='post' action='TraitConnexion.php'>";
		echo "<fieldset> <legend>Identification</legend>";
		echo "<p>";
			if ( isset($_COOKIE['cookIdent']) ) {
					echo 'Login : <input type="text" name="login" '.' value="' . $_COOKIE['cookIdent'] .'"/> <BR> <BR>';
			}
			else {
					echo 'Login : <input type="text" name="login" /> <BR> <BR>';
			}
			echo "Mot de passe : <input type='password' name='motPasse' /><BR><BR>";
			echo "Se souvenir de moi : <input type='checkbox' name='cb_souvenirMoi' /><BR><BR>";
			echo "<input type='submit' name='Envoyer' value='Valider' />";
		echo "</p>";
		echo"</fieldset>";
		echo "</form>";
	?>
    </body>
	
</html>