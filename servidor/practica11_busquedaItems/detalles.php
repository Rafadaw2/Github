<?php
include "datos.php";

if(isset($_GET['producto'])){
    $idProducto= $_GET["producto"];
    if(isset($productos[$idProducto])){
        echo "<h2>Detalles del Producto</h2>";
        echo "<p><strong>Nombre:</strong> {$producto['nombre']}</p>";
        echo "<p><strong>Categoría:</strong> {$producto['categoria']}</p>";
        echo "<p><strong>Precio:</strong> \${$producto['precio']}</p>";
        echo "<p><strong>Descripción:</strong>{$producto['descripcion']}</p>";
    }else{
        echo "<p>Producto no encontrado.</p>";
    }
}
?>