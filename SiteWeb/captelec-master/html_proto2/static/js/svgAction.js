var selected = undefined;
var navMode = true;

/**
 * update le volet
 */
function setSelected(id) {

    selected = id;
    
    rows.data.forEach(element => {
        if (element.idElem == selected) {
            document.getElementById('nomVolet').innerHTML = element.nom;
            document.getElementById('lastDataVolet').innerHTML = element.val;
            document.getElementById('voirPlus').setAttribute('href', element.link);
            document.getElementById('lmin').innerHTML = element.min;
            document.getElementById('lmax').innerHTML = element.max;
        }

    });

}

/**
 * change le style du svg
 */
function styliser() {
    // ==== MODE NAVIGATION ====
    if (navMode) {

        for (let item of document.getElementsByTagName("g")) {
            item.classList.remove("dataVis_wip");
        }

        rows.data.forEach(element => {
            let curr =  document.getElementById(element.idElem);
            curr.classList.add('clickable');
            let title = document.createElement('title')
            title.innerHTML = document.getElementById(element.idElem + '_li').innerHTML;
            curr.appendChild(title)
            curr.setAttribute('style', '');
        });
    }
    // ==== MODE AFFICHAGE DE DONNEES ==== 
    else {
        for (let item of document.getElementsByTagName("g")) {
            if (!item.classList.contains("clickable")) {
                item.classList.add("dataVis_wip");
            }
        }

        rows.data.forEach(element => {
            let curr =  document.getElementById(element.idElem);
            curr.classList.add('clickable');
            curr.setAttribute('style', 'fill: '+element.color);
        
        });
    }
}

/**
 * marque comme selectionné le patern d'id id
 * @param {*} id : id du patern à marquer comme sélectionné
 */
function activeArea(id) {
    document.querySelectorAll('.is_active').forEach(item => {
        item.classList.remove('is_active');
    });
    document.querySelectorAll('.is_active_data').forEach(item => {
        item.classList.remove('is_active_data');
    })
    if (id != null) {
        document.getElementById(id+"_li").classList.add('is_active');
        // ==== MODE NAVIGATION ====
        if (navMode) {
            document.getElementById(id).classList.add('is_active');
        }
        // ==== MODE AFFICHAGE DE DONNEES ====
        else {
            document.getElementById(id).classList.add('is_active_data');
        }
    }
}


/**
 * change le mode de navigation, mat à jour le style (couleurs) et déselectionne tout
 */
function toggleNavMode() {
    if (navMode) {
        navMode = false;
        styliser();
        activeArea(null);
    } else {
        navMode = true;
        styliser();
        activeArea(null);
    }
}

// === INITIALISATION ===
// deselection de tout (zone svg / menu latéral)
document.getElementsByTagName('svg').item(0).addEventListener('mouseleave', function(e){activeArea(null)});
document.getElementsByTagName('ul').item(0).addEventListener('mouseleave', function(e){activeArea(null)});
styliser();

rows.data.forEach(element => { // pour tous les ids indiqués dans data
    // on recupere les objet sur la page (svg et li)
    let svgg = document.getElementById(element.idElem);
    let lielem = document.getElementById(element.idElem+"_li");

    // mise en place action en cas de click sur svg
    svgg.addEventListener('click', (e) => {
        if (navMode) {
            window.location.href = element.link;
        } else {
            setSelected(e.target.parentNode.id);
        }
    });

    // mise en place action en cas de click sur li
    lielem.addEventListener('click', (e) => {
        if (navMode) {
            window.location.href = element.link;
        } else {
            setSelected(e.target.id.replace('_li', ''));
        }
    });

    // on met en place les actions de selection (pour svg et li)
    svgg.addEventListener('mouseenter', function(e){activeArea(element.idElem);});
    lielem.addEventListener('mouseenter', function(e){activeArea(element.idElem);});
});





// bouton retour
document.getElementById('back').addEventListener('click', (e) => {
    window.location.href = rows.GoBackLink;
});


// === BOUTON DE MODE ===
// positionnement bouton
let menuW = document.getElementById("listMenu").clientWidth + 10;
document.getElementById("bt").setAttribute('style', 'transform: translate('+menuW+'px, 10px);');

// action bouton (aparition fenetre)
document.getElementById("bt").addEventListener("click", (e)=>{
    document.getElementsByClassName("volet").item(0).classList.toggle("oppenVollet");
    if (navMode) {
        e.target.setAttribute('value', 'Mode : data');
        document.cookie = "mode=dataMode";
    } else {
        e.target.setAttribute('value', 'Mode : menu');
        document.cookie = "mode=menuMode";
    }
    toggleNavMode();
});

if(document.cookie.includes('dataMode')) {
    document.getElementById("bt").click();
}