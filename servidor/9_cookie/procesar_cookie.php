<?php
if(isset($_POST["nombre"])){
    
    setcookie("nombre_usuario", $_POST['nombre'],time()+3600);
    /*Es importante saber que no puedo acceder a la cookie así hasta que alla una
    nueva solicitud y venga en la cabecera
    echo "La cookie: ".$_COOKIE['nombre_usuario'];
    Podría hacerse asignando el setcookie a una varianle y luego dandosela 
    a *$_COOKIE['nombre_usuario']
    
    setcookie("usuario", "Antonio", [
    'expires' => time() + 86400, // Expira en 1 día
    'path' => '/', // Disponible en todo el dominio
    'domain' => 'ejemplo.com', // Dominio donde se envía la cookie
    'secure' => true, // Solo a través de HTTPS
    'httponly' => true, // No accesible a través de JavaScript
    'samesite' => 'Lax' // Envío en solicitudes de origen cruzado
    permitido*/
    echo 'Creamos la cookie';
    
} else{
    if(isset($_COOKIE['nombre_usuario'])){
        echo 'Bienvenido de nuevo, '.$_COOKIE['nombre_usuario'].'.';
    }
}
?>