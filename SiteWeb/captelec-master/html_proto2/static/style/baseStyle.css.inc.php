<?php
    require_once('config.php');
?>
header {
    background-color: <?=$themes[$_COOKIE['themUsed']]['headerBg']?>;
    margin: 0;
    <?=(isset($hidenav))? 'padding: 25px' : 'padding: 25px 25px 0 25px;'?>

}
h1 {
    font-size: 3.5rem;
    margin: 0;
    padding: 0;
}
table {
    border-collapse: collapse;
}
html {
    padding: 0;
}
body {
    padding: 0;
    margin: 0;
    background-color: <?=$themes[$_COOKIE['themUsed']]['bg']?>;
    color: <?=$themes[$_COOKIE['themUsed']]['fg']?>;
}

nav ul{
    list-style-type: none;
    display: flex;
    justify-content: center;
    margin-bottom: 0;
}
nav ul li{
    cursor: pointer;
    text-align: center;
    border-color: <?=$themes[$_COOKIE['themUsed']]['border']?>;
    border-style: solid;
    border-width: 0 1px 1px 1px;
    padding: 10px;
    width: 20%;
    margin: 0;
}
nav ul li:hover, .navActiv{
    background-color: <?=$themes[$_COOKIE['themUsed']]['highlightTxtBg']?>;
}