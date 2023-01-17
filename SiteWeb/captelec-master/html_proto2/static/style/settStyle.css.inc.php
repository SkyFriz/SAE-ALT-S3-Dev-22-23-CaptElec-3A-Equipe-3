<?php
    require_once('static/include/authCheck.php');
    require_once('config.php');
?>
#formCtn {
    display: flex;
    flex-direction: column;
    align-items: center
}

#navPart label {
    padding-left: 50px;
}

#formCtn div {
    width: 30%;
}

#sub{
    width: 30%;
    padding: 10px;
    margin-top: 50px;
    border-color: <?=$themes[$_COOKIE['themUsed']]['border']?>;
    border-radius: 5px;
    background-color: <?=$themes[$_COOKIE['themUsed']]['sideMenuBG']?>;
    color: <?=$themes[$_COOKIE['themUsed']]['fg']?>;
}

#sub:hover{
    background-color: <?=$themes[$_COOKIE['themUsed']]['highlightTxtBg']?>;
}

select {
    align-self: center;
    //width: 100%;
    padding: 10px;
    margin-left: 50px;
    border-color: <?=$themes[$_COOKIE['themUsed']]['border']?>;
    border-radius: 5px;
    background-color: <?=$themes[$_COOKIE['themUsed']]['sideMenuBG']?>;
    color: <?=$themes[$_COOKIE['themUsed']]['fg']?>;
}