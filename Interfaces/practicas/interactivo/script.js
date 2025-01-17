function validar(){
    let nombre=document.getElementById('nombre').value;
    let email=document.getElementById('email').value;

    if(nombre.length>0 && email.length>0 ){
        return true;
    }else{
        let val=document.getElementById('validacion');
        val.innerText="Debes introducir algo";
        return false;
    }

}