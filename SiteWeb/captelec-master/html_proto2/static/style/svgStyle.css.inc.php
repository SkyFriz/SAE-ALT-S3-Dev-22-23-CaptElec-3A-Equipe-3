<?php
    require_once('static/include/authCheck.php');
    require_once('config.php');
?>
g {
    fill:<?=$themes[$_COOKIE['themUsed']]['fill']?>;
    stroke:<?=$themes[$_COOKIE['themUsed']]['stroke']?>;
    
    fill-opacity:1;
    stroke-width:1px;
    stroke-linecap:round;
    stroke-linejoin:round;
    stroke-opacity:1;
    
    transition: fill 0.5s, stroke 0.5s
}
g.clickable{
    cursor: pointer;
    fill:<?=$themes[$_COOKIE['themUsed']]['fillclickable']?>;
    stroke:<?=$themes[$_COOKIE['themUsed']]['strokeclickable']?>;
}
g.clickable.is_active {
    fill:<?=$themes[$_COOKIE['themUsed']]['fillhighlight']?>;
    stroke:<?=$themes[$_COOKIE['themUsed']]['strokehighlight']?>;
}

g.clickable.is_active_data {
    stroke:<?=$themes[$_COOKIE['themUsed']]['fillhighlight']?>;
    position: relative;
    z-index: -1;
    stroke-width:5px;
}

g.dataVis_wip {
  fill-opacity: 0;
  stroke-opacity: 0.25;
}

#scale {
    height : 15px;
    margin : 10px 0 0 0;
    background: linear-gradient(90deg, rgba(0,255,0,1) 0%, rgba(255,0,0,1) 100%);
}
#legend {
    margin: 0;
    font-size: 0.8rem;
}
