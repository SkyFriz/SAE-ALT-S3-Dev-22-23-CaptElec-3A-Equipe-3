// B201, B202 , B203 , B212, B234
const cars = ["B101", "B102","B103","B105","B106","B108","B109","B110","B111","B112","B113","B201","B202","B203","B001","B002","B003","B212","B217","B219","B234"];
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

const socket = new WebSocket('ws://51.38.52.224/api/');

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
    console.log((Math.floor(Date.now() / 1000)));

    let unix = (Math.floor(Date.now() / 1000)) - 1000;

    console.log("Message");
    console.log(data);
    

    
    for (let i = 0; i < data.length; i++) {
      
          if((data[i][0])=="temperature" && cars.includes(data[i][1]) && data[i][3]>unix ){
           
            console.log("Source " , data[i][0]);
            console.log("Nom de la salle ",data[i][1]);
            console.log("Valeur ",data[i][2]);
            let temps = data[i][2];
            const paths = document.getElementsByClassName(data[i][1]);
            let couleur = null;


            switch (temps) {
              case 17:
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
              case 23:
                couleur = rougeFonce
                break;
              default:
                if (temps>23){
                  couleur = rougeFonce
                }
                else if (temps<17){
                  couleur = bleuFonce
                }
                console.log(`Sorry, we are out of ${temps}.`);
            }
            
            for (let k = 0; k < paths.length; k++) {
              paths[k].setAttribute("fill", `rgb(${couleur})`);
            }
          }

          
        
    
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