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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];

    $directory = './data/';

    $path = $directory . basename($fileName);

    $dia = date('d');
    $mes = date('m');
    $folderPath = "uploads/$dia" . "_$mes" . "_nuevaFlota";
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    $fileDestination = $folderPath .  basename($fileName);
    move_uploaded_file($fileTmp, $fileDestination);
    $extension = explode('.', $extension);
    $vehiculos = [];
    $conductores = [];

    if ($extension[1] == 'json') {
        $jsonData = file_get_contents($fileDestination);
        $data = json_decode($jsonData, true);
        $vehiculos = $data['vehiculos'];
        $conductores = $data['conductores'];
    } else if ($extension[1] == 'csv') {
        /*Con fopen obtienes un puntero al archivo con r lees(read)*/
        $punteroCSV = fopen($fileDestination, 'r');

        /*Extrae una linea del csv en formato array, se hace antes del bucle
        para desecharla porque son los encabezados*/
        $datos = fgetcsv($punteroCSV);

        while (($datos = fgetcsv($punteroCSV)) !== false) {

            array_push($vehiculos,$datos);
        }
    }
    $nVehiculos = count($vehiculos);
    $nConductores = count($conductores);



    foreach ($vehiculos as $vehiculo) {
        $repositorio->insertVehiculos($vehiculo['id'], $vehiculo['matricula'], $vehiculo['tipo']);
        $repositorio->insertLog($_SESSION['admin'], $nVehiculos, $nConductores);
    }

    foreach ($conductores as $conductor) {
        $repositorio->insertConductor($conductor['id'], $conductor['nombre'], $conductor['telefono']);
        $repositorio->insertLog($_SESSION['admin'], $nVehiculos, $nConductores);
    }
}
