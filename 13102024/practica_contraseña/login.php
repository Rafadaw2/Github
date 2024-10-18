<?php
$user_password=[
    'paco'=>password_hash('1234',PASSWORD_DEFAULT),
    'rafa'=>password_hash('12345',PASSWORD_DEFAULT),
    'pepe'=>password_hash('54321', PASSWORD_DEFAULT),
];
$usuario=$_POST['user'];
$contraseña=$_POST['password'];
$esverificado=array_key_exists($usuario,$user_password);

if($esverificado==true){
    print('Usuario verificado\n') ;
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