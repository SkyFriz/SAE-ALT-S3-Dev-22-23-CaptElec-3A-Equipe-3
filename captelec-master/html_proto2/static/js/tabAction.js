rows.data.forEach(element => {
    document.getElementById(element.idRow).addEventListener('click', (e) => {
        window.location.href = element.link;
    });
});

document.getElementById('back').addEventListener('click', (e) => {
    window.location.href = rows.GoBackLink;
});