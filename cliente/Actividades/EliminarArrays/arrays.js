let array_elementos=[];
function añadir_elemento(){
    let elemento=prompt("Inserta el elemento deseado");
    array_elementos.push(elemento);

}

function borrar_ultimo_elemento(){
    //Borra el ultimo elemento del array
    array_elementos.pop();
}

function borrar_primer_elemento(){
    //Borra el primer elemento del array
    array_elementos.shift();
}

function borrar_elemento(){
    elemento=prompt("Introduce el elemento que quieres eliminar");
    //Obteniene el indice de un elemento del array
    let posicion=array_elementos.indexOf(elemento);
    if(posicion==-1){
        alert("Ese elemento no existe");
    }else{
        /*A través de la posicion elimina tantos elementos
        como le indiques en el segundo parametro*/
        array_elementos.splice(posicion,1);
    }

}

function mostrar_elementos(){
    console.log(array_elementos);
    alert(array_elementos);
}