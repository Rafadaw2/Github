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

$rutaDestino = "../uploads/";
$rutaTemporal = $_FILES['json']['tmp_name'];
$rutaDestinoArchivo = $rutaDestino . basename($_FILES['json']['name']);

//Si no existe creamos la carpeta
if (!file_exists($rutaDestino)) {
    mkdir($rutaDestino, 0777, true);
}

move_uploaded_file($rutaTemporal, $rutaDestinoArchivo);
$cadenaJson = file_get_contents($rutaDestinoArchivo);
$arrayJson = json_decode($cadenaJson);

foreach($arrayJson as $elemento){

   if($elemento=='vehiculo' && !isset($elemento['coordenada_x'])){
    $elemento['coordenada_x']=0;
   }
   if($elemento=='vehiculo' && !isset($elemento['coordenada_y'])){
    $elemento['coordenada_y']=0;
   }
   if($elemento=='vehiculo' && !isset($elemento['alarma_revision'])){
    $elemento['alarma_revision']=0;
   }

}
$repositorio->insertarConductores($arrayJson['conductores']);
$repositorio->insertarVehiculos($arrayJson['vehiculo']);




