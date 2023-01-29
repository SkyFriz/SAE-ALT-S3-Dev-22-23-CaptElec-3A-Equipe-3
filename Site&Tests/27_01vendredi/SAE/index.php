<?php
    session_start();
    $cookie_type="type";
    if(!empty($_POST['Source'])){
        $cookie_valueType=$_POST['Source'];
    }
    
    else{
        $cookie_valueType="temperature";
    }
    setcookie($cookie_type,$cookie_valueType);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="svg/styleSVG.css"/>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body class="body">
        <div class="container">
            <div class="item1">
                <?php
                    include 'include/head.php';
                ?>
            </div>
            <div class="item2">
                <div class="legende">
                    <div class="select1">
                        <?php
                            if(!empty($_GET['batiment'])){
                                if($_GET['batiment'] == 'batimentB/rdc' || $_GET['batiment'] == 'batimentB/1etage' || $_GET['batiment'] == 'batimentB/2etage'){
                                    echo "<img src='svg/image/temperature.png' alt='Temperature' style='width:200px;height:200px; padding-left: 100%'>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <?php
                    if(!empty($_GET['batiment'])){
                        include 'svg/'.$_GET['batiment'].'.html';
                    }
                    else{
                        include 'svg/batimentIUT.html';
                    }
                ?>
                <hr>
                <form action="" method="GET">
                    <input type="submit" name="batiment" value="batimentIUT">
                    <input type="submit" name="batiment" value="batimentB">
                    <input type="submit" name="batiment" value="batimentB/rdc">
                    <input type="submit" name="batiment" value="batimentB/1etage">
                    <input type="submit" name="batiment" value="batimentB/2etage">
                </form>
                <hr>
            </div>
        </div>
    </body>
    <script type= module src="./svg/test.js"></script>
    <script>
        const menuHamburger = document.querySelector(".menu-hamburger")
        const navLinks = document.querySelector(".nav-links")
 
        menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })
  </script>
</html>