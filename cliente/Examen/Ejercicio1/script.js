let users=["Paco", "Pepe", "Jose"];
let contraseñas=["12345678","12345678","12345678"];
let div= document.createElement("div");
let body=document.querySelector("body");
let html="<form><label for='usuario'>Usuario</label><input type='text' name='usuario' id='usuario'><label for='password'>password</label><input type='password' name='password1' id='password1'><label for='password2'>Repite password</label><input type='password' name='password2' id='password2' ><input type='button' value='Añadir Usuario'  id='boton'></form>";
div.innerHTML=html;
body.appendChild(div);
let boton = document.getElementById('boton');
boton.addEventListener("click", validarFormulario);
identificador=0;


function validarFormulario(){
    let inputs=document.querySelectorAll("input");
    let esCorrecto=true;
    for(let input of inputs){
        if(input.value.length==0){
            alert("Fatla el campo: "+input.name);
            esCorrecto=false;
        }
    }
    if(inputs[1].value!==inputs[2].value){
        alert("Las contraseñas deben ser iguales");
        esCorrecto=false;
    }else if(inputs[1].value==inputs[2].value){
        if(inputs[1].value.length<8){
            alert("Longitud no válida");
            esCorrecto=false;
        }
    }
    if(esCorrecto==true){
        validarUsuario();
    }

}

function validarUsuario(){
    let usuario=document.querySelectorAll("input")[0].value;
    let password=document.querySelectorAll("input")[1].value;
    if(users.includes(usuario)==true){
        let pos=users.indexOf(usuario);
        contraseñas[pos]=password;
        mostrarDatos();
    }else{
        users.push(usuario);
        contraseñas.push(password);
        mostrarDatos();
    }
}
function mostrarDatos(){
    let ul=document.getElementsByTagName("ul");
    if(ul.length>0){
        ul[0].remove();
    }
    let lista=document.createElement("ul");
    
    for(let user in users){
        let elemento=document.createElement("li");
        elemento.innerText=users[user]+" "+contraseñas[user];
        let boton=document.createElement("button");
        boton.id=identificador;
        boton.onclick=(event) => borrarUser(event);
        boton.innerText="Borrar";
        elemento.appendChild(boton);
        lista.appendChild(elemento);
    }
    body.appendChild(lista);

}
function cifrarContraseña(contraseña){
    subcadena = contraseña.substring(2,contraseña.length-2);
            emailDividido[0]=emailDividido[0].replace(subcadena,"***");
            elemento.innerText=emailDividido.join('@');
}
function borrarUser(event){
    let eliminar = event.target.id;
    users.splice(eliminar, 1);
    contraseñas.splice(eliminar,1);
    mostrarDatos();
}