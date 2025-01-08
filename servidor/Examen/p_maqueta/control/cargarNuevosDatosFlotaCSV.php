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
$vista = new VistaHTML();

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: autenticar.php');
    exit;
}
if (isset($_FILES['archivo'])) {
    $rutaDestino = "../uploads/";
    $rutaTemporal = $_FILES['archivo']['tmp_name'];
    $rutaDestinoArchivo = $rutaDestino . basename(date('d') . '_' . date('m') . '_' . $_FILES['archivo']['name']);

    if (move_uploaded_file($rutaTemporal, $rutaDestinoArchivo)) {
        echo 'Archivo subido correctamente </br>';
    } else {
        echo 'Error subiendo archivo </br>';
    }

    /*Con fopen obtienes un puntero al archivo con r lees(read)*/
    $punteroCSV = fopen($rutaDestinoArchivo, 'r');

    /*Extrae una linea del csv en formato array, se hace antes del bucle
para desecharla porque son los encabezados*/
    $datos = fgetcsv($punteroCSV);
    $num_vehiculos_nuevos = 0;
    $num_conductores_nuevos = 0;

    while (($datos = fgetcsv($punteroCSV)) !== false) {
        $id = $datos[0];
        $tipo = $datos[2];
        $matricula = $datos[1];
        $alarma = 0;
        $coordenada_x = 0;
        $coordenada_y = 0;
        if (strlen($matricula) == 8 && (strtolower($tipo) == 'camion' || strtolower($tipo) == 'furgoneta')) {

            $repositorio->insertarVehiculo($id, $tipo, $matricula, $alarma, $coordenada_x, $coordenada_y);
            $num_vehiculos_nuevos++;
        } else {
            echo "Los datos proporcionados no son validos";
        }
    }
    $id_admin = $_SESSION['usuario'];
    $fecha_subida = date('d-m-y');
    
   
    $repositorio->insertarRegistro($id_admin, $fecha_subida, $num_vehiculos_nuevos, $num_conductores_nuevos);
}
