<?php
require_once "../clases/RepositoryMySQL.php";
require_once "../clases/VistaHTML.php";

$vistaHTML=new VistaHTML();
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
$vehiculos_dis=$repositorio->obtenerVehiculosDisponibles();
$vehiculos_nodis=$repositorio->obtenerVehiculosNoDisponibles();

$entregas_pendientes=$repositorio->obtenerEntregasPendientes();
$entregas_completadas=$repositorio->obtenerEntregasCompletadas();
$sumatorio_tr=0;
$sumatorio_tm=0;
$total=count($entregas_completadas);
foreach($entregas_completadas as $entrega){
    $sumatorio_tr+=$entrega['tiempo_real'];
    $sumatorio_tm+=$entrega['tiempo_maximo'];
}
$promedio_real=$sumatorio_tr/$total;
$promedio_maximo=$sumatorio_tm/$total;

$kmvehiculos=$repositorio->obtenerKmVehiculos();
$localidad=$repositorio->obtenerCiudadConMasEntregas();
$kmconductores=$repositorio->obtenerKilometrosConductor();

$vistaHTML->mostrarVehivulosDisponiblesNoDis($vehiculos_dis,$vehiculos_nodis);
$vistaHTML->mostrarEstadoEntregas($entregas_pendientes,$promedio_real,$promedio_maximo);
$vistaHTML->mostrarRendimientoCostes($kmvehiculos,$localidad,$kmconductores);
?>
