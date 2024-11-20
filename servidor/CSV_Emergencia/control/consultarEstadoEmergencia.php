<?php
//COMPLETAR ESTE MODULO
//1.-importar clases de soporte necesarias
require_once "../clases/RepositorioMYSQL.php";
require_once "../clases/VistaHTML.php";
//2.- Obtener los municipios Afectados

$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "emergencia";    // Nombre de la base de datos

$repositorio = new RepositorioMYSQL(
    $servername,
    $dbname,
    $username,
    $password
);
$municipiosAfectados=$repositorio->obtenerMunicipiosConMasAfectados();
//3.- Obtener el número total de afectados
$totalAfectados=$repositorio->obtenerNumeroTotalAfectados();
//4.-Mostrar el resultado con la vista
$vista=new VistaHTML();
$vista->mostrarEstadoMunicipios($municipiosAfectados,$totalAfectados);