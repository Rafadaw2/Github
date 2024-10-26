let url1='./img/paisaje1.jpg';
let url2='./img/paisaje2.jpg';
let url3='./img/paisaje3.jpg';
let imagenes=[url1, url2, url3];
let imagen = document.getElementById('img');

function moverI(){
for(let img in imagenes){
    if(imagenes[img]==imagen.src && img==0){
        imagen.src=imagenes[imagenes.length-1];
        let boton = document.getElementById(imagenes.length-1);
        boton.checked=true;
    }else if(imagenes[img]==imagen.src && img>0){
        imagen.src=imagenes[img-1];
        let boton = document.getElementById(img-1);
        boton.checked=true;

    } 
}
}
function moverD(){
    for(let img in imagenes){
        if(imagenes[img]==imagen.src && img<imagenes.length-1){
            imagen.src=imagenes[img+1];
            let boton = document.getElementById(img+1);
            boton.checked=true;
        }else if(imagenes[img]==imagen.src && img==imagenes.length-1){
            imagen.src=imagenes[imagenes[0]];
            let boton = document.getElementById(0);
            boton.checked=true;
        }
    }
}
function añadirFoto(){
let fotoañadida=prompt("Introduce una url");
imagenes.push(fotoañadida);
let radioB =document.createElement("input");
radioB.type="radio";
radioB.id=imagenes.length;
radioB.name="marcador";
let divMarcadores=document.querySelector(".marcadorPosicion");
divMarcadores.append(radioB);
}