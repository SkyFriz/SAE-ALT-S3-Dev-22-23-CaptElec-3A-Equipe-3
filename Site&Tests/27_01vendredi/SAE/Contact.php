<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contact</title>
        <link rel="stylesheet" href="styleContact.css"/>
        <?php
          include 'include/head.php';
        ?>
    </head>
    <body>
    <div class="container">
<div class="card">
  <div class="face face1">
    <div class="content">
      <span class="stars"></span>
      <h2 class="Egxon">Egxon Zejnullahi</h2>
        <p class="Egxon">c'est occupé a gérer github (scrum master) et a réaliser le script python qui récupère les données pour ensuite les envoyées dans la base de donnée mysql, et a crée des graphiques avec graphana.
        <a href = "mailto: abc@example.com" class=""> egxon@hotmail.fr</a>
      </p>
    </div>
  </div>
  <div class="face face2">
    <h2>Egxon</h2>
  </div>
</div>

<div class="card">
  <div class="face face1">
    <div class="content">
      <span class="stars"></span>
        <h2 class="Marco">Marco Valle</h2>
        <p class="Marco">a crée la base de donnée, crée des script.</p>
        <a href = "mailto: abc@example.com" class=""> marco.valle@etu.univ-tlse2.fr</a>
    </div>
  </div>
  <div class="face face2">
    <h2>Marco</h2>
  </div>
</div>

<div class="card">
  <div class="face face1">
    <div class="content">
      <span class="stars"></span>
      <h2 class="Thomas">Thomas Testa</h2>
        <p class="Thomas">a réalisé le site, son design et son fonctionnement.</p>
        <a href = "mailto: abc@example.com" class=""> thomas.testa@etu.univ-tlse2.fr</a>
    </div>
  </div>
  <div class="face face2">
    <h2>Thomas</h2>
  </div>
</div>
</div>
    </body>
</html>