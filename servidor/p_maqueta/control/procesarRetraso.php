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

if(isset($_GET['localidad'])){
    $localidad=$_GET['localidad'];

    $entregas_pendientes=$repositorio->obtenerEntregasNoCompletadas();
    foreach($entregas_pendientes as $entrega){
        if($entrega['localidad']==$localidad){

            $entrega['tiempo_maximo']=$entrega['tiempo_maximo']*1.2;
            $repositorio->incrementarTiempoMaximoPendientes($entrega['id'],$entrega['tiempo_maximo']);

        }
    }
}