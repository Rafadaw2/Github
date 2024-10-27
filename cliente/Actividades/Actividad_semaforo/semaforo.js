let boton = document.getElementsByTagName("button");
boton[0].addEventListener("click", crearSemaforo);
function crearSemaforo() {

    //Hacemos desaparecer el boton
    boton[0].style.display = "none";

    //Creamos los cuadrados del semaforo
    let div1 = document.createElement("div");
    let div2 = document.createElement("div");
    let div3 = document.createElement("div");

    //Los añado al body primero para tratarlos en grupo despues
    let body = document.getElementsByTagName("body");
    body[0].append(div1);
    body[0].append(div2);
    body[0].append(div3);

    /*Les aplicamos el css y añadimos los id a cada div
    y los escuchadores*/
    let divs = document.getElementsByTagName("div");
    let i = 0;
    for (let elemento of divs) {
        elemento.setAttribute("style", "width: 8rem; height: 8rem; background-color:gray; border: 1px solid white;");
        elemento.id = i++;
        elemento.addEventListener("mouseover", onmouse);
        elemento.addEventListener("mouseout", onmouse);
    }

}

function onmouse(event) {
    if (event.type == "mouseout") {
        let divs = document.getElementsByTagName("div");
        for (let elemento of divs) {
            elemento.style.backgroundColor = "gray";
        }
    } else {
        let elementoDisparador = event.target;
        if (elementoDisparador.id == 0) {
            elementoDisparador.style.backgroundColor = "green";
        } else if (elementoDisparador.id == 1) {
            elementoDisparador.style.backgroundColor = "yellow";
        } else {
            elementoDisparador.style.backgroundColor = "red"
        }
    }

}