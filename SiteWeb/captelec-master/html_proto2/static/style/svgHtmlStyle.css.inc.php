<?php
    require_once('static/include/authCheck.php');
    require_once('config.php');
?>
#primaryCtn {
    display: flex;
}
#secondCtn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    flex-direction: column;
}
svg{
    width: 90%;
}
p{
    margin: 20px;
}
#listMenu {
    min-width: 15%;
    background-color: <?=$themes[$_COOKIE['themUsed']]['sideMenuBG']?>;
    min-width: max-content;
}
#listMenu ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    min-width: max-content;
}

#listMenu ul li {
    cursor: pointer;
    min-width: max-content;
    border-bottom: 1px solid <?=$themes[$_COOKIE['themUsed']]['border']?>;
    padding: 5px 15px 5px 15px;
}
#listMenu ul li.is_active {
    background-color: <?=$themes[$_COOKIE['themUsed']]['highlightTxtBg']?>;
}

#back {
    padding: 15px;
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