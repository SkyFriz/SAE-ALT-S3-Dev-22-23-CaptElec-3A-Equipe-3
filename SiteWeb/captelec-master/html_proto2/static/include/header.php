<header>
	<h1>
        CaptElec
        <span style="font-size: 1rem;">
            (v2)
        </span>
            <img src="<?=$rootURL?>static/img/Logo_IUT_Blagnac.png" alt="logo de l'iut de blagnac" width="10%" align="right">
    </h1>
    <?php
        if (!isset($hidenav)) {
            echo '<nav>';
            echo '<ul>';
            echo '<li id="btNavig" >Navigation</li>';
            echo '<li id="btParam">Paramètres</li>';
            echo '<li id="btDeco">Déconnexion</li>';
            echo '</ul>';
            echo '</nav>';
        }
    ?>
</header>

<?php
    if (!isset($hidenav)) {
        echo '<script>';
        echo 'const navlinks = {'.$navLinks.'};';
        echo 'const navActiv = "'.$_GET[$urlAttr['atRoute']].'";';
        echo '</script>';
        echo '<script src="'.$rootURL.'static/js/navAction.js"></script>';
    }
?>