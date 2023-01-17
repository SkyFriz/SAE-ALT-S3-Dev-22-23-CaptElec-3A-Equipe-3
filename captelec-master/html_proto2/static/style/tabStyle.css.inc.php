<?php
    require_once('static/include/authCheck.php');
    require_once('config.php');
?>
th {
    border-bottom: solid <?=$themes[$_COOKIE['themUsed']]['border']?> 4px;
    padding-left: 50px;
}
td {
    border-bottom: solid <?=$themes[$_COOKIE['themUsed']]['border']?> 1px;
    padding-top: 10px;
}
.changeHoverd:hover{
    background-color: <?=$themes[$_COOKIE['themUsed']]['highlightTxtBg']?>;
}
.start {
    padding-left: 0;
    text-align: left;
}
.numberCell {
    text-align: right;
}
#conteneur {
    display: flex;
    justify-content: center;
}
#pathDisplay {
    margin: 0 0 25px 0;
    padding: 25px 25px 0 25px;
}