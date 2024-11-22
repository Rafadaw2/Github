<?php
session_start();
//empty devuelve true si el array esta vacio
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    echo "<h1>Contenido del Carrito</h1>";
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $item) {
        echo "<li>" . htmlspecialchars($item) . "</li>";
    }
    echo "</ul>";
    echo '<p><a href="index.html">Volver a la tienda</a></p>';
} else {
    echo "<h1>El carrito está vacío</h1>";
    echo '<p><a href="index.html">Volver a la tienda</a></p>';
}
/*// Eliminar una variable de la sesión
unset($_SESSION['usuario']);
// Destruir la sesión
session_destroy();
 */
?>