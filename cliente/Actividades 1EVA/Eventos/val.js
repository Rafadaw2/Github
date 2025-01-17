let usuario=document.getElementById("text");
usuario.addEventListener("blur",valUser);

/*Recordar que si quieres cambiar el texto de una etqieuta
usaremos .innetTEXT o innerHTML (tambien para machacarlo 
sustituyendolo por otra etiqueta. Sin embargo, cuando quieres
acceder al texto de un input:text será con un .value al igual que
para acceder a cualquier atributo.*/

/*Eventos:
    -blur: cuando pierde el foco.
    -DOMContentLoaded: Se dispara cuando el DOM ha sido completamente 
    cargado y analizado, pero antes de que los recursos como imágenes 
    y hojas de estilo se hayan cargado.
    -scroll: Se dispara repetidamente mientras el usuario desplaza (hace scroll)
    el contenido visible de una página o elemento.
    -load: Se dispara cuando toda la página, incluidas las imágenes, hojas de estilo 
    y otros recursos, han sido completamente cargados.
 */

function valUser(){
    
    
    let mensajeUser=document.getElementById("user");
    let mensajeUserInvalid=document.getElementById("userInvalid");
    let usuariosNoPermitidos=['root','admin','sysadmin', 'Administrador','Administrator'];
    if(usuario.value.length<6){
        mensajeUser.innerHTML="Debes introducir almenos un caracter y maximo 6";
    }else{
        mensajeUser.innerHTML="";
    }
    if(usuariosNoPermitidos.includes(usuario.value)){
        mensajeUserInvalid.innerHTML="El usuario "+usuario.value+" no es valido";
    }
}

usuario.addEventListener("focus",styleUser);
usuario.addEventListener("blur",styleUser);

function styleUser(event){
    if(event.type=="focus"){
    usuario.style.backgroundColor="gray";
    usuario.style.color="white";
    }else if(event.type=="blur"){
        //Para quitar un atributo.
        usuario.removeAttribute("style");
        
    }
}
let contraseña=document.getElementById("pass");
contraseña.addEventListener("blur",valPassword);
function valPassword(){
    
    let numeros=[0,1,2,3,4,5,6,7,8,9];
    let errorPass=document.getElementById("errorPass");
    let cantidadNumeros=0;
    for(let numero of numeros){
        if(contraseña.value.includes(numero)){
            cantidadNumeros++;
        }
    }
    if(cantidadNumeros<1 || contraseña.value.length<8){
        errorPass.innerHTML="La contraseña debe incluir al menos un numero y 8 caracteres.";
    }else{
        errorPass.innerHTML="";
    }
}

let contraseñaRepetida=document.getElementById("passRepeat");
contraseñaRepetida.addEventListener("blur",compararPassword);
let errorPassRepeat=document.getElementById("errorPassRepeat");
function compararPassword(){
    if(contraseña.value!=contraseñaRepetida.value){
        errorPassRepeat.innerHTML="Las constraseñas deben coincidir";
        /*Importante innerHTML no es valido para campos de entrada debes usar value*/
        contraseña.value="";
        contraseñaRepetida.value="";
        contraseña.focus();
    }else{
        errorPassRepeat.innerHTML="";
    }
}