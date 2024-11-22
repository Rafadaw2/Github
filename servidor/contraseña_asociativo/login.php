<?php
/*Con password_hash ciframos la contraseña siempre debemos guardarla cifrada*/
$user_password=[
    'paco'=>password_hash('1234',PASSWORD_DEFAULT),
    'rafa'=>password_hash('12345',PASSWORD_DEFAULT),
    'pepe'=>password_hash('54321', PASSWORD_DEFAULT),
];
$usuario=$_POST['user'];
$contraseña=$_POST['password'];

/*>Con array_key_exists comprobamo si un cadena este en un array,
en este caso si el usuario existe */
$esverificado=array_key_exists($usuario,$user_password);

if($esverificado==true){
    print('Usuario verificado\n') ;
    /*Si existe comprobamos que la contraseña introducida coincide con el hass guardado
    lo hacemos con password_verify */
    $passworde_es_correcta=password_verify($contraseña,$user_password[$usuario]);
    if($passworde_es_correcta==true){
        print('La contraseña es correcta');
    }else{
        print('La contraseña es incorrecta');
    }
}elseif($esverificado==false){
    print('Usuario no verificado') ;
}
?>