<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';
$vista = new VistaHTML();
$servername = "mysql";
$username = "root";
$password = "1234";
$dbname = "FLOTA";

$repositorio = new RepositoryMySQL($servername, $username, $password, $dbname);
if(isset($_SESSION['admin'])){
    
    $vehiculos=$repositorio->vehiculosRevision();
    $aRevisarMatricula=[];
    foreach ($vehiculos as $vehiculo) {
        if($vehiculo['kilometros']>1000){
            $aRevisarMatricula[]=$vehiculo['matricula'];
        }
    }
    
    $vista->mostrarRevision($aRevisarMatricula);
}else{
    header('location:autenticar.php');
}

