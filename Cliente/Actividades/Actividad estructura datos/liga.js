
let equipos=[], jugadores=[];
let equipo1 = {
    nombre: "Real Madrid",
    sede: {
        nombreEstadio: "Santiago Bernabéu",
        calle: "Av. de Concha Espina, 1",
        cp: "28036"
    },
    golesFavor: 20,
    golesContra: 10
}
let equipo2 = {
    nombre: "FC Barcelona",
    sede: {
        nombreEstadio: "Spotify Camp Nou",
        calle: "Carrer d'Arístides Maillol, s/n",
        cp: "08028"
    },
    golesFavor: 70,
    golesContra: 20
}

equipos.push(equipo1,equipo2);

let jugador1 = {
    nombre: "Karim",
    apellido: "Benzema",
    dorsal: 9,
    goles: 27,
    posicion: "Delantero",
    tarjetasAmarillas: 2,
    tarjetasRojas: 0
}
let jugador2 = {
    nombre: "Sergio",
    apellido: "Busquets",
    dorsal: 5,
    goles: 2,
    posicion: "Mediocampista",
    tarjetasAmarillas: 10,
    tarjetasRojas: 1
}
let jugador3 = {
    nombre: "Pedri",
    apellido: "González",
    dorsal: 8,
    goles: 5,
    posicion: "Mediocampista",
    tarjetasAmarillas: 4,
    tarjetasRojas: 0
};

let jugador4 = {
    nombre: "David",
    apellido: "Alaba",
    dorsal: 4,
    goles: 2,
    posicion: "Defensa",
    tarjetasAmarillas: 3,
    tarjetasRojas: 0
};

let jugador5 = {
    nombre: "Ansu",
    apellido: "Fati",
    dorsal: 10,
    goles: 7,
    posicion: "Delantero",
    tarjetasAmarillas: 1,
    tarjetasRojas: 0
};

jugadores.push(jugador1, jugador2,jugador3, jugador4, jugador5);



function liga() {
    console.table(equipos);
    console.table(jugadores);

}