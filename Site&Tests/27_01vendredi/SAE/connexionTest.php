<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
    <link rel="stylesheet" href="connexion.css"/>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup" method='post' action='newUser.php'>
				<form>
					<label for="chk" aria-hidden="true">S'enregistrer</label>
					<input type="text" name="txt" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>S'enregistrer</button>
				</form>
			</div>

			<div class="login" method='post' action='TraitConnexion.php'>
				<form>
					<label for="chk" aria-hidden="true" style="padding-top: 10px;">Se connecter</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Se connecter</button>
				</form>
			</div>
	</div>
</body>
</html>