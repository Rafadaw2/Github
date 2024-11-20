
//Funciones para habilitar o deshabilitar botones
let btnPedirCarta = document.querySelectorAll("button")[1];
let btnPlantarse = document.querySelectorAll("button")[2];
let body = document.querySelector("body");




let barajaJuego = [];

//Crea la pantalla principal
function crearPantalla() {
    //Guardamos el numero de jugadores
    let num=document.getElementById("jugadores").value;
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
    body.innerHTML=html;

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
    //Creamos el div que contiene la info de cada jugador
    for(let i=0;i<Number(numeroJugadores);i++){
    let div = document.createElement("div");
    div.className = "col tex-center";

    //Creamos div con nombre del jugador
    let divrow1=document.createElement("div");
    divrow1.className="row";
    let h1Jugador=document.createElement("h1");
    h1Jugador.id=i;
    divrow1.appendChild(h1Jugador);
    div.appendChild(divrow1);

    //Creamos div con puntuacion del jugador
    let divrow2=document.createElement("div");
    divrow2.className="row";
    let h1Puntuacion=document.createElement("h1");
    h1Puntuacion.id=i;
    divrow2.appendChild(h1Puntuacion);
    div.appendChild(divrow2);

    //Añadimos el div con todo al html
    let divJugadores = document.getElementById("divJugadores");
    divJugadores.appendChild(div);

    }

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
    let numeros = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];
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
    let valor = 0;

    //Elimanamos de la baraja la carta seleccionada
    barajaJuego.pop();

    //


}

function puntosCarta(carta) {
    //Obtenemos la puntuación de la carta

    //Actualizamos la puntuación

    let puntuación = document.querySelectorAll(".jugador1");

}

function plantarse(){

}