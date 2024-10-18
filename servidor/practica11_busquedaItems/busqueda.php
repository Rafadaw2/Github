<?php
include 'datos.php';
if(isset($_GET["busqueda"])){
    $busqueda=strtolower($_GET["busqueda"]);
    $busquedaSanitizada=htmlspecialchars($busqueda);
    echo "Resultados de la busqueda: </br>";
    foreach($productos as $producto){
        $se_encuentra=strpos(strtolower($producto),$busqueda);
        if($se_encuentra!==false)
    }
}
?>