<?php
include 'datos.php';
if(isset($_GET["busqueda"])){
    $busqueda=strtolower($_GET["busqueda"]);
    $busquedaSanitizada=htmlspecialchars($busqueda);
    echo "Resultados de la busqueda: </br>";
    echo "<ul>";
    foreach($productos as $id=>$producto){
        $se_encuentraNombre=strpos(strtolower($producto["nombre"]),$busqueda);
        $se_encuentraDescripcion=strpos(strtolower($producto["categoria"]),$busqueda);
        if($se_encuentraNombre!==false || $se_encuentraDescripcion!==false){
            echo "<li><a href='detalles.php?producto=$id'>Ver detalles {$producto['nombre']} - {$producto['categoria']}</a></li>";
        }
    }
    echo "/ul";

}
?>