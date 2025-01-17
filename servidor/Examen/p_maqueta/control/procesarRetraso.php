<?php
require "../clases/RepositoryMySQL.php";
require "../clases/VistaHTML.php";

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: autenticar.php');
    exit;
}

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

if(isset($_POST['localidad'])){
    $localidad=$_POST['localidad'];
    $porcentaje=20;
    $repositorio->aumentarTiempoMaximo($porcentaje, $localidad);
    $vista->mostrarAumentoTiempoMazimo($porcentaje, $localidad);
}