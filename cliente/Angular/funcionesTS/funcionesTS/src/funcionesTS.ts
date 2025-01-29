interface portero{
    nombre:string,
    paradas:number,
    partidos:number
}
interface jugador{
    nombre:string,
    goles:number,
    faltas:number,
    partidos:number
}

function crearPorteros(nombre:string,paradas:number,partidos:number):portero{
    let porteroCreado:portero={
        nombre: nombre,
        paradas: paradas,
        partidos: partidos
    }
    return porteroCreado;
}
function crearJugador(nombre:string,goles:number,faltas:number,partidos:number):jugador{
    let player:jugador={
        nombre: nombre,
        goles: goles,
        faltas: faltas,
        partidos: partidos
    }
    return player;
}
let array:(portero | jugador)[]=[];
let rafa=crearPorteros('rafa',1,2);
array.push(rafa);
let ruben=crearPorteros('ruben',4,5);
array.push(ruben);
let calculin=crearPorteros('calculin',1,3);
array.push(calculin);

let alex=crearJugador('alex',2,3,4)
array.push(alex)
let pedro=crearJugador('pedro',1,2,3);
array.push(pedro)
let nico=crearJugador('nico',4,5,6);
array.push(nico)

console.table(array);