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
			require_once('static/style/svgStyle.css.inc.php');
			require_once('static/style/svgHtmlStyle.css.inc.php');
			require_once('static/style/voletStyle.css.inc.php');
		?>
	</style>
</head>
<body>
	<?php require('static/include/header.php');?>





	<?php if($etg){ ?>
		<div class="volet">
			<h2 id="nomVolet">____</h2>
			<p>
				Dernier relevé :
				<span id="lastDataVolet">___</span>
				Wh
			</p>
			<a href="" id="voirPlus">Détail</a>
			<div id="scale"></div>
			<p id=legend>(<span id="lmin">--</span>Wh -> <span id="lmax">--</span>Wh)</p>
		</div>
	<?php } ?>
	




	<div id="primaryCtn">
		<div id="listMenu">
			<?=$listMenu?>
		</div>
		<?php if($etg){ ?>
			<input type="button" id="bt" value="Mode : menu">
		<?php } ?>
		<div id="secondCtn">
            <p id="pathDisplay"><?=$diplayPath?></p>
            <?php require('static/svg/'.$selectedSVG);?>
        </div>
	</div>


	<script>
		function updateSizesOnResize() {
			let winH = window.innerHeight;
			let headerH = document.getElementsByTagName('header').item(0).offsetHeight;

			document.getElementById('listMenu').style.height = winH-headerH+"px";
		}
		window.addEventListener("load", updateSizesOnResize());
		window.addEventListener('resize', updateSizesOnResize());
	</script>
	<script>
		const rows = {
			"data" : [<?=$jsElements?>],
			"GoBackLink" : "<?=$jsBackLink?>"
		};
	</script>
    <script src="<?=$rootURL?>static/js/svgAction.js"></script>

</body>
</html>