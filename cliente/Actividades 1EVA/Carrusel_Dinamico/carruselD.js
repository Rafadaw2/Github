let url1="./img/paisaje1.jpg";
let url2="./img/paisaje2.jpg";
let url3="./img/paisaje3.jpg";
let imagenes=[url1, url2, url3];
let imagen = document.getElementById('img');
let posicion=0;
imagen.src=imagenes[posicion];


function moverI(){
    if(posicion==0){
        posicion=imagenes.length-1;
        /*Recuerda que el codigo se lee de arriba abajo si no le
        das la intruccion de que cambie la imagen con la siguiente
        linea por mucho que actualices el valor de posicion
        no va a cambiar. */
        imagen.src=imagenes[posicion];
        let boton=document.getElementById(posicion);
        boton.checked=true;

    }else{
        posicion--;
        imagen.src=imagenes[posicion];
        let boton=document.getElementById(posicion);
        boton.checked=true;
    }
}
function moverD(){
   if(posicion==imagenes.length-1){
    posicion=0;
    imagen.src=imagenes[posicion];
    let boton=document.getElementById(posicion);
        boton.checked=true;
   }else{
    posicion++;
    imagen.src=imagenes[posicion];
    let boton=document.getElementById(posicion);
        boton.checked=true;
   }
}
function añadirFoto(){
let fotoañadida=prompt("Introduce una url: ./img/paisaje4.jpg,./img/paisaje5.jpg o ./img/paisaje6.jpg");
imagenes.push(fotoañadida);
let radioB =document.createElement("input");
radioB.type="radio";
radioB.id=imagenes.length-1;
radioB.name="marcador";
let divMarcadores=document.querySelector(".marcadorPosicion");
divMarcadores.append(radioB);
}