<?php
    session_start();
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
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                        if(!empty($_POST['etage'])){
                            $svg_rdc_url= 'svg/'.$_POST['batiment'].'/'.$_POST['etage'].'.svg';
                        $svg_rdc_content= file_get_contents($svg_rdc_url);
                        echo $svg_rdc_content;
                        }
                        else{
                            $svg_rdc_url= 'svg/'.$_POST['batiment'].'.svg';
                            $svg_rdc_content= file_get_contents($svg_rdc_url);
                            echo $svg_rdc_content;
                        }
                    }
                ?> 
                <hr>
                <form action="" method="POST">
                    <input type="submit" name="batiment" value="batimentB/rdc">
                    <input type="submit" name="batiment" value="batimentB/1etage">
                    <input type="submit" name="batiment" value="batimentB/2etage">
                    <input type="submit" name="batiment" value="batimentB">
                    <input type="submit" name="batiment" value="batimentIUT">
                </form>
                <hr>
            </div>
        </div>
    </body>
    <script>
        const menuHamburger = document.querySelector(".menu-hamburger")
        const navLinks = document.querySelector(".nav-links")
 
        menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })
  </script>
</html>