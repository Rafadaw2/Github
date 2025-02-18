/*
Con esta url obtenemos el numero de peliculas.
http://localhost:3000/numeroPelis

Con esta url http://localhost:3000/peli1 obtenemos la pelicula1

*/

function obtenerDatos(url, callback) {
    fetch(url)
        .then((respuesta) => {
            if (!respuesta.ok) {
                return callback(`Error HTTP ${respuesta.status}`, null);
            }
            return respuesta.json().then((datos) => callback(null, datos));
        })
        .catch((error) => callback(`Error de red: ${error.message}`, null)); // Captura errores de conexión
}
let numeroPelis=0
function recogerNumPelis(error = null, datos = null) {
    if (error !== null) {
        console.log(error); // Muestra el error en consola
    } else {
        console.log("datos es la respuesta")
        console.table(datos); // Muestra los datos si no hubo error
        numeroPelis=datos['cantidad'];
        console.log(numeroPelis);
        imprimirPelis(numeroPelis);
    }
}
obtenerDatos('http://localhost:3000/numeroPelis', recogerNumPelis);


function imprimirPelis(numeroPelis = null){
   
        console.log('2fun'+numeroPelis); // Muestra los datos si no hubo error
        for(let i=1;i<=numeroPelis;i++){
            obtenerDatos('http://localhost:3000/peli'+i,pintar)
        }
        
    

}
function pintar(error,peli){
    if(error!=null){
        console.log(error);
    }else{

        console.table(peli)
        const ulPelis=document.getElementById('pelis');
        let li=document.createElement('li');
        li.innerText=peli['titulo'];
        ulPelis.append(li);
        console.log(nombre);
    }
}

// obtenerDatos("http://localhost:3000/numeroPelis", imprimirPelis(recogerNumPelis));
// obtenerDatos("http://localhost:3000/numeroPelis", recogerNumPelis);
// let numeroPelis=fetch('http://localhost:3000/numeroPelis');



