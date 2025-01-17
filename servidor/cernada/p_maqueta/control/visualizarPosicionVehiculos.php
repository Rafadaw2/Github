<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';
$vista=new VistaHTML();
$servername = "mysql";
$username = "root";
$password = "1234";
$dbname = "FLOTA";

$repositorio = new RepositoryMySQL($servername, $username, $password, $dbname);

$posicionVehiculos=$repositorio->posicionVehiculosEnRuta();

$vista->mostrarPosicion($posicionVehiculos);
