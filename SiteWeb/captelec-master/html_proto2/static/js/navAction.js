Object.entries(navlinks).forEach(element => {
    let curr = document.getElementById(element[0])
    if (element[1].includes(navActiv)) {
        curr.classList.add('navActiv')
    } else {
        curr.addEventListener('click', (e) => {
            window.location.href = element[1];
        });
    }
});