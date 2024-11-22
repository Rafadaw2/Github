
//Funciones para habilitar o deshabilitar botones
let btnPedirCarta = document.querySelectorAll("button")[1];
let btnPlantarse = document.querySelectorAll("button")[2];
let body = document.querySelector("body");
let valor = 0;

/*Para los turnos, cuando se crean los jugadores puedo crear un array con
numeros 1,2,3... y revolverlo asi los turnos cambian con una variable 
let jugador actual=arrayJugadores[0] si te planta la posicion se incrementa
cambiando asi de jugador y podria guardar en el la puntuación si quiero.*/

/*Para aumentar la puntuación podría crear una función que a partir del numero
a sumar y el jugador actual sumara la puntuación */

let listaJugadores = [];
let listaPuntuaciones = [];
let jugadorActual;
let possActual = 0;
console.log
let barajaJuego = [];

//Crea la pantalla principal
function crearPantalla() {
    //Guardamos el numero de jugadores
    let num = document.getElementById("jugadores").value;
    //Variable con el body del juego
    let html = "<div class=\"container\"> \
    <div class=\"row\"> \
        <div class=\"col text-center\"> \
            <button class=\"btn btn-primary\">Nuevo juego</button> \
            <button class=\"btn btn-primary\">Pedir carta</button> \
            <button class=\"btn btn-primary\">Plantarse</button> \
        </div> \
    </div> \
    </div> \
    <div class=\"container\"> \
    <div class=\"row\"> \
        <div class=\"col\"> \
            <div class=\"jugador-cartas\"> \
                <img class=\"carta\" src=\"./cartas/grey_back.png\"> \
            </div> \
        </div> \
    </div> \
    </div> \
    <div class='container fixed-bottom'> \
    <div id=\"divJugadores\" class='row'> \
    </div> \
    </div>";


    //Reemplazo el body
    body.innerHTML = html;

    inhabilitar();

    //Configuramos los eventos de los botones
    let btnNuevoJuego = document.querySelectorAll("button")[0];
    let btnPedirCarta = document.querySelectorAll("button")[1];
    let btnPlantarse = document.querySelectorAll("button")[2];
    btnNuevoJuego.addEventListener("click", crearPartida);
    btnPedirCarta.addEventListener("click", pedirCarta);
    btnPlantarse.addEventListener("click", plantarse);

    crearJugadores(num);



}

function crearJugadores(numeroJugadores) {
    if (numeroJugadores < 2) {
        numeroJugadores = 2;
    }
    //Creamos el div que contiene la info de cada jugador
    for (let i = 0; i < Number(numeroJugadores); i++) {

        let div = document.createElement("div");
        div.className = "col tex-center";
        let idJugador = i + 1;

        //Creamos div con nombre del jugador
        let divrow1 = document.createElement("div");
        divrow1.className = "row";
        let h1Jugador = document.createElement("h1");
        h1Jugador.innerText = "Jugador" + idJugador;
        h1Jugador.id = h1Jugador.innerText;
        divrow1.appendChild(h1Jugador);
        div.appendChild(divrow1);

        //Creamos div con puntuacion del jugador
        let divrow2 = document.createElement("div");
        divrow2.className = "row";
        let h1Puntuacion = document.createElement("h1");
        h1Puntuacion.innerText = "Puntuacion: ";
        let puntuacion = document.createElement("span");
        puntuacion.id = "p" + h1Jugador.innerText;
        puntuacion.innerText = 0;
        puntuacion.style.fontSize = "5vh";
        divrow2.appendChild(h1Puntuacion);
        divrow2.appendChild(puntuacion);
        div.appendChild(divrow2);
        
        //Creamos array de jugadores
        listaJugadores.push(h1Jugador.innerText);
        //Tabla de puntuaciones

        let divrow3 = document.createElement("div");
        divrow3.className = "row";
        let tabla = document.createElement("table");
        let filaTr = document.createElement("tr");
        let cabeceras = ["Partidas Ganadas"];
        for (let cabecera of cabeceras) {
            let th = document.createElement("th");
            th.innerText = cabecera;
            filaTr.append(th);
        }
        tabla.append(filaTr);

        let fila = document.createElement("tr");
        let tdGanadas = document.createElement("td");
        tdGanadas.innerText = 0;

        tdGanadas.id = "pg" + listaJugadores[i];
        fila.append(tdGanadas);
        tabla.append(fila);



        divrow3.append(tabla);
        div.append(divrow3);



        //Añadimos el div con todo al html
        let divJugadores = document.getElementById("divJugadores");
        divJugadores.appendChild(div);

    }

    //Mezclamos para que el turno sea diferente siempre
    listaJugadores = _.shuffle(listaJugadores);

    let div = document.createElement("div");
    div.className = "col tex-center";

    //Creamos div con nombre del jugador
    let divrow1 = document.createElement("div");
    divrow1.className = "row";
    let h1Jugador = document.createElement("h1");
    h1Jugador.innerText = "Banca";
    h1Jugador.id = h1Jugador.innerText;
    divrow1.appendChild(h1Jugador);
    div.appendChild(divrow1);

    //Creamos div con puntuacion del jugador
    let divrow2 = document.createElement("div");
    divrow2.className = "row";
    let h1Puntuacion = document.createElement("h1");
    h1Puntuacion.innerText = "Puntuacion: ";
    let puntuacion = document.createElement("span");
    puntuacion.id = "pBanca";
    puntuacion.innerText = 0;
    puntuacion.style.fontSize = "5vh";
    divrow2.appendChild(h1Puntuacion);
    divrow2.appendChild(puntuacion);
    div.appendChild(divrow2);

    //Tabla de puntuaciones

    let divrow3 = document.createElement("div");
    divrow3.className = "row";
    let tabla = document.createElement("table");
    let filaTr = document.createElement("tr");
    let cabeceras = ["Partidas Ganadas"];
    for (let cabecera of cabeceras) {
        let th = document.createElement("th");
        th.innerText = cabecera;
        filaTr.append(th);
    }
    tabla.append(filaTr);

    let fila = document.createElement("tr");
    let tdGanadas = document.createElement("td");
    tdGanadas.innerText = 0;

    tdGanadas.id = "pgBanca";
    fila.append(tdGanadas);
    tabla.append(fila);



    divrow3.append(tabla);
    div.append(divrow3);

    //Mezclamos para que el turno sea diferente siempre
    listaJugadores = _.shuffle(listaJugadores);

    //Creamos array de jugadores
    listaJugadores.push(h1Jugador.innerText);

    //Añadimos el div con todo al html
    let divJugadores = document.getElementById("divJugadores");
    divJugadores.appendChild(div);

    jugadorActual = listaJugadores[0];
    let jugador = document.getElementById(jugadorActual);
    jugador.style.color = "green";



}

function crearPartida() {
    barajaJuego = crearBaraja();
    habilitar();
}

function inhabilitar() {
    let btnPedirCarta = document.querySelectorAll("button")[1];
    let btnPlantarse = document.querySelectorAll("button")[2];
    btnPedirCarta.disabled = true;
    btnPlantarse.disabled = true;
}
function habilitar() {
    let btnPedirCarta = document.querySelectorAll("button")[1];
    let btnPlantarse = document.querySelectorAll("button")[2];
    btnPedirCarta.disabled = false;
    btnPlantarse.disabled = false;
}

//crea la baraja dinámicamente y la mezcla
function crearBaraja() {
    let numeros = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];
    let palos = ["H", "D", "C", "S"];
    let baraja = [];

    for (let valor of numeros) {
        for (let palo of palos) {
            let carta = valor + palo;
            baraja.push(carta);
        }
    }
    baraja = _.shuffle(baraja);
    return baraja;
}

function pedirCarta() {
    /* Se saca una carta del final y se borra la ultima posicion del array*/
    //Seleccionamos la ultima carta
    numeroCartas = barajaJuego.length;
    let cartaRobada = barajaJuego[numeroCartas - 1];



    //Seleccionamos las imagenes
    let cartasMesa = document.querySelector(".jugador-cartas");

    //Creamos una etiqueta img para mostrar la carta robada
    let img = document.createElement("img");
    let rutaCartas = "./cartas/";
    let extension = ".png";
    let rutaEspecifica = rutaCartas + cartaRobada + extension;
    img.src = rutaEspecifica;
    img.className = "carta";

    //Una vez preparada la etiqueta la añadimos a la mesa
    cartasMesa.append(img);

    //Obtener valor de carta
    let valor = puntosCarta(cartaRobada);
    

    //Obtenemos la puntuación del jugador y actualizamos
    let puntuación = document.getElementById("p" + jugadorActual);
    puntuación.innerText = Number(puntuación.innerText) + Number(valor);

    //Elimanamos de la baraja la carta seleccionada
    barajaJuego.pop(cartaRobada);

    if (puntuación.innerText > 21) {
        alert("Siguiente turno,¡Te has pasado!");

        plantarse();
    }


}

function puntosCarta(cartaRobada) {
    //Obtenemos la puntuación de la carta
    let valor = 0;
    let figuras = ["J", "Q", "K"];
    let esfigura = false;
    for (let figura of figuras) {
        if (cartaRobada.includes(figura)) {
            esfigura = true;
        }
    }

    if (cartaRobada.includes("A")) {
        //Destino
        let cabecera = document.getElementsByClassName("container")[0];

        //Generamos la estructura
        let div = document.createElement("div");
        div.className = "row";
        div.id = "eleccion";

        let elige = document.createElement("h3");
        elige.innerText = "Enhorabuena, has conseguido un AS, ¿que valor quieres elegir?";
        div.append(elige);

        let btnElec1 = document.createElement("input");
        btnElec1.type = "button";
        btnElec1.value = "1";
        btnElec1.addEventListener("click", valorAs);
        div.appendChild(btnElec1);

        let btnElec11 = document.createElement("input");
        btnElec11.type = "button";
        btnElec11.value = "11";
        btnElec11.className = "mb-3";
        btnElec11.addEventListener("click", valorAs);
        div.appendChild(btnElec11);

        //Lo añadimos a destino
        cabecera.append(div);

    } else if (esfigura == true) {
        valor = 10;
    } else {
        valor = cartaRobada.replace(/\D/g, "");
    }
    //Devolvemos la puntuación
    return valor;

}


function plantarse() {
    // Limpiamos la mesa
    let mesa = document.querySelectorAll("img");

    for (let carta in mesa) {
        if (carta > 0) {
            mesa[carta].remove();
        }
    }

    // Descoloreamos al jugador que ha terminado
    let jugadorOld = document.getElementById(jugadorActual);
    if (jugadorOld) {
        jugadorOld.style.color = "";
    }

    // Guardamos la puntuación del jugador que terminó
    let puntuacionOld = document.getElementById("p" + jugadorActual).innerText;
    listaPuntuaciones[possActual] = Number(puntuacionOld);

    // Avanzamos el turno
    possActual++;
    if (possActual >= listaJugadores.length-1) {
        jugadorActual = "Banca";
        banca();
        return;
    }

    // Coloreamos al nuevo jugador
    jugadorActual = listaJugadores[possActual];
    let jugadorNew = document.getElementById(jugadorActual);
    if (jugadorNew) {
        jugadorNew.style.color = "green";
    }


}

function valorAs(event) {
    let puntuacionAs = event.target.value;
    let puntuacionActual = document.getElementById("p" + jugadorActual);
    puntuacionActual.innerText = Number(puntuacionActual.innerText) + Number(puntuacionAs);

    let formEleccion = document.getElementById("eleccion");
    formEleccion.remove();

}
function banca() {
    let puntosBanca = document.getElementById("pBanca").innerText;
    while (Number(puntosBanca) < 17) { 
        pedirCarta();
        puntosBanca = document.getElementById("pBanca").innerText;
    }

    if (puntosBanca > 21) {
        alert("La banca se ha pasado. Fin del juego.");
    }

    calcularGanador();
  

}

function calcularGanador() {
    let puntosBanca = listaPuntuaciones[listaPuntuaciones.length - 1];
    let ventiuno = 21;
    let diferenciaBanca = ventiuno - puntosBanca;

    for (let i = 0; i < listaPuntuaciones.length - 1; i++) {

        if (listaPuntuaciones[i] <= ventiuno) {

            let diferenciaJugador = ventiuno - Number(listaPuntuaciones[i]);

            if (listaPuntuaciones[i] == ventiuno || puntosBanca > ventiuno) {

                let celdaJugador = document.getElementById("pg" + listaJugadores[i])
                celdaJugador.innerText = Number(celdaJugador.innerText) + 1;

            } else if (diferenciaJugador < diferenciaBanca) {

                let celdaJugador = document.getElementById("pg" + listaJugadores[i])
                celdaJugador.innerText = Number(celdaJugador.innerText) + 1;
            }

        }
    }
}