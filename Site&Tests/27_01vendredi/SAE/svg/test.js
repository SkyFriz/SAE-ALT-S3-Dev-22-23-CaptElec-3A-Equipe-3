const paths = document.getElementsByClassName("p");
let currentColor = 0;
let colorIncrement = 5;

for (let i = 0; i < paths.length; i++) {
  setInterval(() => {
    currentColor += colorIncrement;
    if (currentColor >= 255) {
      currentColor = 255;
      colorIncrement = -colorIncrement;
    } else if (currentColor <= 0) {
      currentColor = 0;
      colorIncrement = -colorIncrement;
    }
    paths[i].setAttribute("fill", `rgb(${currentColor},0,${255-currentColor})`);
  }, 150);
}
