<?php
include 'datos.php';
if(isset($_GET["busqueda"])){
    $busqueda=strtolower($_GET["busqueda"]);
    //$busquedaSanitizada=htmlspecialchars($busqueda);
    echo "<h2>Resultados de la busqueda: </h2>";
    echo "<ul>";
    foreach($productos as $id=>$producto){
        $se_encuentraNombre=strpos(strtolower($producto["nombre"]),$busqueda);
        $se_encuentraDescripcion=strpos(strtolower($producto["categoría"]),$busqueda);
        if($se_encuentraNombre!==false || $se_encuentraDescripcion!==false){
            echo "<li><a href='detalles.php?producto=$id'>Ver detalles {$producto['nombre']} - {$producto['categoría']}</a></li>";
        }
    }
    echo "</ul>";

}
?>