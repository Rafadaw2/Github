let array_elementos=[];
function añadir_elemento(){
    let elemento=prompt("Inserta el elemento deseado");
    array_elementos.push(elemento);

}

function borrar_ultimo_elemento(){
    array_elementos.pop();
}

function borrar_primer_elemento(){
    array_elementos.shift();
}

function borrar_elemento(){
    elemento=prompt("Introduce el elemento que quieres eliminar");
    let posicion=array_elementos.indexOf(elemento);
    if(posicion==-1){
        alert("Ese elemento no existe");
    }else{
        array_elementos.splice(posicion,1);
    }

}

function mostrar_elementos(){
    console.log(array_elementos);
    alert(array_elementos);
}