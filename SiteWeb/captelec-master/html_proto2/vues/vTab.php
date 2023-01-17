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
			require_once('static/style/tabStyle.css.inc.php');
		?>
	</style>
</head>
<body>
	<?php require('static/include/header.php')?>
	<p id="pathDisplay"><?=$diplayPath?></p>
	<div id="conteneur">
		<div>
			<?=$dataTable;?>
			<p>*(toutes les mesures sont en Wh)</p>
			<p>**(agrégation contenant des mesures fictives)</p>
		</div>
	</div>
	<script>
		const rows = {
			"data" : [<?=$jsRows?>],
			"GoBackLink" : "<?=$jsBackLink?>"
		};
	</script>
	<script src="<?=$rootURL?>static/js/tabAction.js"></script>
</body>
</html>