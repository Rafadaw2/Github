
//Funciones para habilitar o deshabilitar botones
let btnPedirCarta = document.querySelectorAll("button")[1];
let btnPlantarse = document.querySelectorAll("button")[2];
inhabilitar();
let barajaJuego = [];


function crearPartida() {
    barajaJuego = crearBaraja();
    habilitar();
}

function inhabilitar() {
    btnPedirCarta.disabled = true;
    btnPlantarse.disabled = true;
}
function habilitar() {

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
    console.log(cartasMesa);

    //Creamos una etiqueta img para mostrar la carta robada
    let img = document.createElement("img");
    let rutaCartas = "./cartas/";
    let extension = ".png";
    let rutaEspecifica = rutaCartas + cartaRobada + extension;
    img.src = rutaEspecifica;
    img.className = "carta";

    //Una vez preparada la etiqueta la añadimos a la mesa
    cartasMesa.append(img);

    //Elimanamos de la baraja la carta seleccionada
    barajaJuego.pop();

    //


}