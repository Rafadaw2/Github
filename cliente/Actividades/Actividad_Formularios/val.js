function valUser(){
    let usuario=document.forms["Registro"].elements["usuario"].value;
    let mensajeUser=document.getElementById("user").value;
    let mensajeUserInvalid=document.getElementById("userInvalid").value;
    let usuariosNoPermitidos=['root','admin','sysadmin', 'Administrador','Administrator'];
    if(usuario.length<6){
        mensajeUser="Debes introducir almenos un caracter y maximo 6";
    }
    if(usuariosNoPermitidos.includes(usuario)){
        mensajeUserInvalid="El usuario "+usuario+" no es valido";
    }
}