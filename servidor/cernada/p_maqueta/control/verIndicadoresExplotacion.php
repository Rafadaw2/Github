<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';
$vista=new VistaHTML();
$servername = "mysql";
$username = "root";
$password = "1234";
$dbname = "FLOTA";

$repositorio = new RepositoryMySQL($servername, $username, $password, $dbname);

//Los no disp. son los totales - los disp.
$disponibles=$repositorio->disponiblesFlota();
$totales=$repositorio->totalVehiculos();
$noDisponibles=$totales['totales']-$disponibles[0]['total_disponibles'];

$entregasEnProceso=$repositorio->entregasEnProceso();
$promedioTiempoReal=$repositorio->promedioTiempoReal();
$promedioTiempoMaximo=$repositorio->promedioTiempoMaximo();
$aTiempo='Mayor';
if($promedioTiempoMaximo[0]['tiempo_maximo']>$promedioTiempoReal[0]['tiempo_real']){
    $aTiempo='inferior';
}

$vehiculos=$repositorio->kmsTotales();
$ciudadMasEntregas=$repositorio->ciudadMasEntregas();

$nombreYKms=$repositorio->costePorConductor();







//Mostramos la vista
$vista->mostrarExplotacionFlota($disponibles[0]['total_disponibles'], $noDisponibles, $entregasEnProceso[0]['total'], $promedioTiempoMaximo[0]['tiempo_maximo'],
$promedioTiempoReal[0]['tiempo_real'], $aTiempo, $vehiculos, $ciudadMasEntregas[0]['localidad'], $nombreYKms);

