<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/styleInclnclude.css">
  </head>
  <body class="menu">
    <nav class="navbar">
        <a href="#" class="logo">CaptElec</a>
        <div class="nav-links">
            <ul>
                <li><a onclick="window.location.href='index.php'">Accueil</a></li>
                <li><a onclick="window.location.href='Contact.php'">Contact</a></li>
                <?php
                  if (!isset($_SESSION['identifie']) OR isset($_SESSION['identifie'])!='OK') {
                    echo("<li><a onclick=\"window.location.href='connexion.php'\">Connexion</a></li>");
                    header('location:connexion.php?msgErreur=');
                    exit();
                  }
                  else{
                    echo("<li><a onclick=\"window.location.href='Deconnexion.php'\">Déconnexion</a></li>");
                  }
                ?>
                
            </ul>
        </div>
        <img src="include/img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
    </nav>
  </body>
  <script>
        const menuHamburger = document.querySelector(".menu-hamburger")
        const navLinks = document.querySelector(".nav-links")
 
        menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })
  </script>
</html>


