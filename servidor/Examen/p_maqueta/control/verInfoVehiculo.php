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

if(isset($_GET['matricula'])){
    $matricula=$_GET['matricula'];
    $vehiculo=$repositorio->obtenerDatosVehiculo($matricula);
    $vista->mostrarDetalleVehiculo($vehiculo);
}else{
    echo "Error";
}