<?php
session_start();
//Siempre debemos poner session_start() al principio para poder usar la sesion

if (isset($_GET['libro'])) {
    //htmlspecialchars sirve para sanitizar la entrada
    $libro = htmlspecialchars(($_GET['libro']));
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    /*El [] que va despues del sesion sirve para añadir 
    un nuevo valor al final del array*/
    $_SESSION['carrito'][] = $libro;
    echo "<h1>Libro Comprado!</h1>";
    echo "<p>Has comprado: <strong>$libro</strong></p>";
    echo '<p><a href="index.html">Seguir comprando</a></p>';
} else {
    echo "<h1>Error</h1>";
    echo "<p>No se ha seleccionado ningún libro.</p>";
    echo '<p><a href="index.html">Volver a la tienda</a></p>';
}
?>