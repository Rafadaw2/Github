function validar(){
    let nombre=document.getElementById('nombre').value;
    let email=document.getElementById('email').value;

    if(nombre.length>0 && email.length>0 ){
        return true;
    }else{
        let val=document.getElementById('validacion');
        val.innerText="Debes introducir algo en los campos nombre y email";
        return false;
    }

}
function verMas(){
    let bloque=document.getElementById('ocultar');
    let btn=document.getElementById('btn');
    if(bloque.style.display!='none'){
        bloque.style.display='none';
        btn.innerText='Ver mas...';
    }else{
        bloque.style.display='';
        btn.innerText='Ver menos...';
        
    }
    

}