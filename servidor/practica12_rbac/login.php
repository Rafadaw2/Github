<?php
session_start();
include "roles.php";

if(isset($_POST["username"],$_POST["password"])){
    $usuario=$_POST["username"];
    $contraseña=$_POST["password"];
    foreach($usuarios as $clave=>$valor){
        if($clave==$usuario && $valor["password"]==$contraseña){
            $rol=$valor["rol"];
            if(count($rol)==1){
                if( $rol=="admin"){
                    header("Location: admin.html");
                }elseif($rol=="user"){
                    header("Location: user.html");
                }elseif($rol=="manager"){
                    header("Location: manager.html");
                }
            }elseif(count($rol)>1){
                
            }
        }
    }
    if(!isset($rol)){
        echo "El usuario o contraseña son incorrectos.";
    }
}

?>