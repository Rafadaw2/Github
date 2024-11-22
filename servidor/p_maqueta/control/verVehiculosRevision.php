<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$vistaHTML = new VistaHTML();
$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "FLOTA";    // Nombre de la base de datos

$repositorio = new RepositorioMYSQL(
    $servername,
    $dbname,
    $username,
    $password
);

$vehiculosRevision=$repositorio->vehiculosPendientesRevision();
$vistaHTML->mostrarVehiculosRevision($vehiculosRevision);



