<?php
    session_start();
    $cookie_name="type";    
    if(!empty($_POST['Source'])){
        $cookie_value=$_POST['Source'];
    }
    else{
        $cookie_value="temperature";
    }
    setcookie($cookie_name,$cookie_value);

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
                <div class="select1">
                    <?php
                        if(!empty($_GET['batiment'])){
                            if($_GET['batiment'] == 'batimentB/rdc' || $_GET['batiment'] == 'batimentB/1etage' || $_GET['batiment'] == 'batimentB/2etage'){
                                ?>  <div class="formSelect">
                                        <form action="" method="POST">
                                            <label>Source :</label>
                                            <select name="Source">
                                                <option value="temperature">Température</option>
                                                <option value="co2">CO2</option>
                                            </select><br>
                                            <input type="submit" name="Valider" value="Valider">
                                        </form>
                                    </div>
                                    <div class="typeSelect">
                                        <?php
                                            if(!empty($_POST['Source'])){
                                                echo 'Sélection : '.$_POST['Source'];
                                            }
                                            else{
                                                echo 'Sélection : temperature';
                                            }
                                        ?>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <?php
                    if(!empty($_GET['batiment'])){
                        $svg_rdc_url= 'svg/'.$_GET['batiment'].'.svg';
                        $svg_rdc_content= file_get_contents($svg_rdc_url);
                        echo $svg_rdc_content;
                    }
                    else{
                        $svg_rdc_url= 'svg/batimentIUT.svg';
                        $svg_rdc_content= file_get_contents($svg_rdc_url);
                        echo $svg_rdc_content;
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
    <foot>
        <a href="svg/batimentIUT.html">TEST</a>
    </foot>
    <script>
        const menuHamburger = document.querySelector(".menu-hamburger")
        const navLinks = document.querySelector(".nav-links")
 
        menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })
  </script>
</html>