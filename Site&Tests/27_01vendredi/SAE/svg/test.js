const cars = ["B101", "B102","B103","B105","B106","B108","B109","B110","B111","B112","B113","B201","B202","B203","B001","B002","B003","B212","B233","B219","B234"];
let fLen = cars.length;



let currentColor = 15;
let colorIncrement = 5;


const bleuFonce = [0,0,255];
const bleuClaire = [0,130,255];
const bleuTresClaire = [0,205,255];
const orangeClaire = [255,156,0];
const orangeFonce = [255,88,0];
const rougeClair = [255,0,0];
const rougeFonce = [150,0,0];
/*
for (let j = 0; j < cars.length; j++) {
const paths = document.getElementsByClassName(cars[j]);


for (let i = 0; i < paths.length; i++) {
  setInterval(() => {
    
    paths[i].setAttribute("fill", `rgb(${bleuFonce})`);
  }, 150);
}

}

*/

const socket = new WebSocket('ws://51.38.52.224:8090');

socket.onopen = function() {
    console.log("WebSocket connection established");


    const data = {
        message: "Hello, server!",
        user: "John Smith"
    };
    socket.send(JSON.stringify(data));
    
};

socket.onmessage = function(event) {
    // Handle the received message
    const data = JSON.parse(event.data);
    console.log("Message");
    console.log(data);
    console.log(data[0][0]);
    console.log(data[1][1]);
    console.log(data[1][2]);

    
    for (let i = 0; i < data.length; i++) {
      if(cars.includes(data[i][1])){
        console.log('Nom de la salle')
        console.log(console.log(data[i][1]));

        console.log("Source ")
        console.log(console.log(data[i][6][]));

        console.log("Valeur")
        console.log(console.log(data[i][6]));
      }
    }
  
    if (cars.includes(data[1][1])){


   

    let temps = data[1][2];
    const paths = document.getElementsByClassName(data[1][1]);
    let couleur = null;
    

    switch (temps) {
      case temps<17:
        couleur = bleuFonce
        break;
      case 18:
        couleur = bleuClaire
        break;

      case 19:
        couleur = bleuTresClaire
        break;

      case 20:
        couleur = orangeClaire
        break;
      case 21:
        couleur = orangeFonce
        break;
      case 22:
        couleur = rougeClair
        break;
      case temps>22:
        couleur = rougeFonce
      default:
        console.log(`Sorry, we are out of ${temps}.`);
    }
    
    for (let i = 0; i < paths.length; i++) {
      paths[i].setAttribute("fill", `rgb(${couleur})`);
    }
  }else{
    console.log("pas dans la liste");
  }


    updateWebsite(data);
};

socket.onclose = function() {
    
    console.log("WebSocket connection closed");
    document.getElementById("test_conn").innerHTML = "Connection to the server interrupted";
};

function updateWebsite(data) {
    if (data['test_key'] === 'test_value'){
      document.getElementById("table_data").innerHTML = "amongus ;)";
      return;
    }


    let table = "<table><thead><tr><th>Type de donnÃ©e</th><th>Nom du capteur</th><th>Valeur</th><th>Date</th></tr><thead>";
    data.forEach(row =>  {
        table += "<tr>";
        row.forEach(cell => {
            table += "<td>"+cell+"</td>";
        })
        table += "</tr>";
    });
    table += "</table>";

    console.log("test");


}