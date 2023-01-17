<?php
    require_once('config.php');
?>
body {
	margin: 0;
    background-color: <?=$themes[$_COOKIE['themUsed']]['bg']?>;
    color: <?=$themes[$_COOKIE['themUsed']]['fg']?>;
}

header: {
    margin-bottom: 20%;
}

div {
    margin: 0 auto;
    align-content: center;
    width: 50%;
}
form div {
    width: 30%;
    text-align: center;
}

form {
    margin-top: 25px;
}

.error {
    padding: 20px;
    border: red 3px solid;
    background-color: rgb(255, 188, 188);
    color: red;
    margin-top: 15px;
    border-radius: 10px;
    box-shadow: 8px 8px 12px 3px rgba(135,16,16,0.64);
}

input {
    margin: 10px;
    padding: 5px;
    background-color: <?=$themes[$_COOKIE['themUsed']]['bg']?>;
    color: <?=$themes[$_COOKIE['themUsed']]['fg']?>;
    border-color: <?=$themes[$_COOKIE['themUsed']]['border']?>;
    background-color: <?=$themes[$_COOKIE['themUsed']]['sideMenuBG']?>;
}

input[type=submit] {
    padding: 5px 25px;
}

input:hover{
    background-color: <?=$themes[$_COOKIE['themUsed']]['highlightTxtBg']?>;
}