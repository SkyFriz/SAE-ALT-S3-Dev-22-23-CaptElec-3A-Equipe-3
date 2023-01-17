<?php
    require_once('static/include/authCheck.php');
    require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CaptElec-Home</title>
	<style>
		<?php
			require_once('static/style/baseStyle.css.inc.php');
			require_once('static/style/settStyle.css.inc.php');
		?>
	</style>
</head>
<body>
	<?php require('static/include/header.php');?>

    <form action="" method="POST">
		<div id="formCtn">
			<div id="navPart">
				<h3>Navigation :</h3>
				<?php if ($currentValues['menuDisplay'] == $cookieNames['menuDisplay']['tab']) {
					echo '<label for="menuDisplaytab">Mode tableaux</label>';
					echo '<input type="radio" name="menuDisplay" id="menuDisplaytab" checked value="'.$cookieNames['menuDisplay']['tab'].'">';
					echo '<br>';
					echo '<label for="menuDisplaysvg">Mode images</label>';
					echo '<input type="radio" name="menuDisplay" id="menuDisplaysvg" value="'.$cookieNames['menuDisplay']['svg'].'">';
				} elseif ($currentValues['menuDisplay'] == $cookieNames['menuDisplay']['svg']) {
					echo '<label for="menuDisplaytab">Mode tableaux</label>';
					echo '<input type="radio" name="menuDisplay" id="menuDisplaytab" value="'.$cookieNames['menuDisplay']['tab'].'">';
					echo '<br>';
					echo '<label for="menuDisplaysvg">Mode images</label>';
					echo '<input type="radio" name="menuDisplay" id="menuDisplaysvg" checked value="'.$cookieNames['menuDisplay']['svg'].'">';
				}
				?>
			</div>

			<div>
				<h3>Theme :</h3>
				<select name="theme" id="theme">
					<?php
						foreach($themes as $key => $val) {
							if ($currentValues['themUsed'] == $key) {
								echo '<option selected value="'.$key.'" >'.$key.'</option>';
							} else {
								echo '<option value="'.$key.'">'.$key.'</option>';
							}
						}
					?>
				</select>
			</div>
			<input type="submit" value="Valider" name="sub" id="sub">
		</div>
	</form>

</body>
</html>