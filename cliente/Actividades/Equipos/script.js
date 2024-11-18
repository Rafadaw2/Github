let diccionario = [];
let equipos = [];
let identificador = 0;


function añadirJugador() {

    //Extraemos los valores del formulario
    let nombreEquipo = document.getElementById("equipo").value,
        nombreJugador = document.getElementById("jugador").value,
        goles = document.getElementById("goles").value,
        tarjetasA = document.getElementById("tarjetasa").value,
        tarjetasR = document.getElementById("tarjetasr").value;

    //Preparamos el obt literal para agregarlo al diccionario
    let jugador = {
        "nombre equipo": nombreEquipo,
        "nombre jugador": nombreJugador,
        "goles": goles,
        "tarjetasA": tarjetasA,
        "tarjetasR": tarjetasR
    }
    //Añadimos
    diccionario.push(jugador);
    console.log(diccionario);

    //Reseteamos los campos del formulario
    let inputs = document.querySelectorAll("input");
    for (input of inputs) {
        if (input.type != "button") {
            input.value = "";
        }
    }
    //Con la función correspondiente actualizamos las stats y la lista de jugadores
    actualizarEstadisticas();
    mostrarJugadores();


}
function actualizarEstadisticas() {
    console.log("Hola");
    let estadisticas = calcularEstadisticas();
    document.getElementById("totalJugadores").innerText = estadisticas["totalJugadores"];
    document.getElementById("totalEquipos").innerText = estadisticas["totalEquipos"];
    document.getElementById("totalGoles").innerText = estadisticas["totalGoles"];
    document.getElementById("totalTarjetasA").innerText = estadisticas["totalTarjetasA"];
    document.getElementById("totalTarjetasR").innerText = estadisticas["totalTarjetasR"];

}
function calcularEstadisticas() {
    let estadisticas = {};
    let totalJugadores = 0, totalEquipos = 0, totalGoles = 0, totalTarjetasA = 0, totalTarjetasR = 0;

    for (jugador of diccionario) {
        if (equipos.includes(jugador["nombre equipo"]) == false) {
            equipos.push(jugador["nombre equipo"]);
        }
        totalGoles += Number(jugador["goles"]);
        totalTarjetasA += Number(jugador["tarjetasA"]);
        totalTarjetasR += Number(jugador["tarjetasR"]);

        totalEquipos = equipos.length;
    }
    totalJugadores = diccionario.length;
    totalEquipos = equipos.length;

    estadisticas = {
        "totalJugadores": totalJugadores,
        "totalEquipos": totalEquipos,
        "totalGoles": totalGoles,
        "totalTarjetasA": totalTarjetasA,
        "totalTarjetasR": totalTarjetasR
    }
    return estadisticas;
}
function eliminarJugador(event) {
    let eliminar = event.target.id;
    diccionario.splice(eliminar, 1);
    actualizarEstadisticas();
    mostrarJugadores();
}

function mostrarJugadores() {

    //Seleccionamos la tabla
    let tabla = document.querySelectorAll("table")[1];
    //let celdas=tabla.querySelectorAll("td");
    let filas = tabla.querySelectorAll("tr");

    //Debo resetear el contador del identificador
    identificador=0;

    //Recorro las filas de la tabla y las borro
    for (let i = 1; i < filas.length; i++) {
        filas[i].remove();
    }


    //Recorremos el diccionario y por cada jugador añadimos fila
    for (jugador of diccionario) {
        let player = tabla.insertRow();
        console.log("Enta en el primer bucle");
        /*No puedes recorrer un objeto literal con un for of
        debes hacerlo con for in*/

        //Recorremos los datos del jugador
        for (dato in jugador) {
            // Por cada dato del jugador insertamos una celda

            let celda = player.insertCell();
            console.log("Enta en el segundo bucle");
            celda.innerText = jugador[dato];
            console.log("Enta en el if");

        }
        let celda = player.insertCell();
        console.log("Enta en el else");
        let boton = document.createElement("input");
        boton.type = "button";
        boton.id = identificador++;
        boton.value = "Borrar";
        /*Para poder meterle una fun al onclick debo hacer una
        funcion flecha o function (){ funcion a invocar}*/
        boton.onclick = (event) => eliminarJugador(event);
        celda.appendChild(boton);


    }
}