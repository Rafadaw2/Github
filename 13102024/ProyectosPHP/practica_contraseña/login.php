<?php
$user_password=[
    'paco'=>password_hash('1234',PASSWORD_DEFAULT),
    'rafa'=>password_hash('12345',PASSWORD_DEFAULT),
    'pepe'=>password_hash('54321', PASSWORD_DEFAULT),
];
/*$usuario=$_POST['user'];
$contraseña=$_POST['password'];
$esverificado=array_key_exists($usuario,$user_password);*/
$usuario_enviado=$_GET['user'];
$contraseña_enviada=$_GET['password'];
$esverificado=array_key_exists($usuario_enviado,$user_password);


if($esverificado==true){
    print('Usuario registrado</br>') ;
    $passworde_es_correcta=password_verify($contraseña_enviada,$user_password[$usuario_enviado]);
    if($passworde_es_correcta==true){
        print('La contraseña es correcta');
    }else{
        print('La contraseña es incorrecta');
    }
}else{
    print('Usuario no registrado') ;
}
?>