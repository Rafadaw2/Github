<?php
require "../clases/RepositoryMySQL.php";
require "../clases/VistaHTML.php";

$servername = "mysql_examen";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "FLOTA";    // Nombre de la base de datos

$repositorio = new RepositoryMYSQL(
    $servername,
    $dbname,
    $username,
    $password
);
$vista=new VistaHTML();

$vehiculos=$repositorio->obtenerPosicionVehiculos();
$vista->mostrarVehiculos($vehiculos);