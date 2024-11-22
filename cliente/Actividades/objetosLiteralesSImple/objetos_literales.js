let array_elementos={};

function añadirElemento(){
    let nombreclave=prompt("Introduce la clave");
    let contenidovalor=prompt("Introduce el valor");
    array_elementos[nombreclave]=contenidovalor;
    /*let elemento = {
        nombreclave: contenidovalor
    }
    array_elementos*/
}

function borrarElementoPorClave(){
    let clave=prompt("Introduce la clave que deseas eliminar");
    delete array_elementos[clave];
}

function mostrarElementos(){
    console.table(array_elementos);
}