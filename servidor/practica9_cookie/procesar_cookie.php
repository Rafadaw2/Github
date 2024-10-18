<?php
if(isset($_POST["nombre"])){
    
    setcookie("nombre_usuario", $_POST['nombre'],time()+3600);
    echo 'Creamos la cookie';
    
} else{
    if(isset($_COOKIE['nombre_usuario'])){
        echo 'Bienvenido de nuevo, '.$_COOKIE['nombre_usuario'].'.';
    }
}
?>