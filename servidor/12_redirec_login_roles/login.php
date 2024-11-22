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
                if( $rol[0]=="admin"){
                    header("Location: admin.html");
                    //Siempre debes usar exit después de header
                    exit;
                }elseif($rol[0]=="user"){
                    header("Location: user.html");
                    exit;
                }elseif($rol[0]=="manager"){
                    header("Location: manager.html");
                    exit;
                }
            }elseif(count($rol)>1){
                echo "<p>Entrar como:</p><br>
                <a href='$rol[0].html'>$rol[0]</a>
                <a href='$rol[1].html'>$rol[1]</a>";
            }
        }
    }
    if(!isset($rol)){
        echo "El usuario o contraseña son incorrectos.";
    }
}

?>