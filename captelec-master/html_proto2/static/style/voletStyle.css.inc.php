#bt {
    position: absolute;
    transform: translate(90px);
}
.volet {
    background-color: <?=$themes[$_COOKIE['themUsed']]['headerBg']?>;
    
    width: 10%;
    padding: 5px;
    padding-top: 0;
    position: absolute;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    right: 0;
    text-align: center;
    
    visibility: hidden;
}
.oppenVollet {
    visibility: visible;
}
#lastDataVolet {
    font-weight: bolder;
}