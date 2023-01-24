<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleInclnclude.css">
  </head>
  <body>
    <nav class="navbar">
        <a href="#" class="logo">CaptElec</a>
        <div class="nav-links">
            <ul>
                <li class="active"><a href="#">Accueil</a></li>
                <li><a href="#">Rechercher</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <img src="img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
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


