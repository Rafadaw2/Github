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
$disponibles=$repositorio->obtenerVehiculosDisponibles();
$no_disponibles=$repositorio->obtenerVehiculosNoDisponibles();
$vista->mostrarDisponibilidad($disponibles['v_disponibles'],$no_disponibles['v_no_disponibles']);

$entregas_pendientes=$repositorio->obtenerEntregasPendientes();
$promedio_real=$repositorio->obtenerMediaTiempoReal();
$promedio_maximo=$repositorio->obtenerMediaTiempoMaximo();
//implementar tiempo de llegada
//vistas
$vista->mostrarEstadoLLegadas($entregas_pendientes, $promedio_real, $promedio_maximo);

$datos_rendimiento=$repositorio->obtenerPrevisionMantenimiento();
$localidadMasEntregas=$repositorio->obtenerCiudadMasEntregas();
$costeConductor=$repositorio->obtenerCosteConductor();

$vista->mostrarRendimiento($datos_rendimiento, $localidadMasEntregas, $costeConductor);
