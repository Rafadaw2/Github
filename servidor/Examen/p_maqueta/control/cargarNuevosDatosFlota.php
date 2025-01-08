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

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: autenticar.php');
    exit;
}
if(isset($_FILES['archivo'])){
    $rutaDestino="../uploads/";
    $rutaTemporal=$_FILES['archivo']['tmp_name'];
    $rutaDestinoArchivo=$rutaDestino.basename(date('d').'_'.date('m').'_'.$_FILES['archivo']['name']);
    
    if(move_uploaded_file($rutaTemporal,$rutaDestinoArchivo)){
        echo 'Archivo subido correctamente </br>';
    }else{
        echo 'Error subiendo archivo </br>';
    }
    


    /*Primero extraemos los datos del json en una cadena con 
    file_get_contents pasandole la ruta donde esta*/
    $cadenaJson= file_get_contents($rutaDestinoArchivo);
    $arrayJson= json_decode($cadenaJson, true);
    $vehiculos=$arrayJson['vehiculos'];
    foreach ($vehiculos as $vehiculo) {
        $id=$vehiculo['id'];
        $tipo=$vehiculo['tipo'];
        $matricula=$vehiculo['matricula'];
        $alarma=0;
        $coordenada_x=0;
        $coordenada_y=0;
        if(strlen($matricula)==8 && (strtolower($tipo)=='camion' || strtolower($tipo)=='furgoneta')){

            $repositorio->insertarVehiculo($id, $tipo, $matricula, $alarma, $coordenada_x, $coordenada_y);
        }else{
            echo "Los datos proporcionados no son validos";
        }
    }
    $conductores=$arrayJson['conductores'];
    foreach ($conductores as $conductor) {
        $id=$conductor['id'];
        $nombre=$conductor['nombre'];
        $telefono=$conductor['telefono'];
        
        $repositorio->insertarCondcutor($id, $nombre, $telefono);
    }
    $id_admin=$_SESSION['usuario'];
    $fecha_subida=date('d-m-y');
    $num_vehiculos_nuevos=count($vehiculos);
    $num_conductores_nuevos=count($conductores);
    $repositorio->insertarRegistro($id_admin, $fecha_subida, $num_vehiculos_nuevos, $num_conductores_nuevos);
}