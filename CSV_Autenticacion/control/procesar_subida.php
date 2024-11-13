<?php
require_once "../clases/RepositorioMYSQL.php";

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

if (isset($_FILES['archivo_csv'])) {
    //1.- Abrir el archivo CSV y leer el nombre del municipio (primer campo)
    $rutaDestino = "../uploads/";
    $rutaTemporal = $_FILES['archivo_csv']['tmp_name'];
    $punteroCSV = fopen($rutaTemporal, 'r');
    $datos = fgetcsv($punteroCSV);
    $datos = fgetcsv($punteroCSV);
    $municipio = $datos[0];
    $folderPath = '/var/www/html/CSV_Autenticacion/uploads/' . $municipio;

    //Si no existe creamos la carpeta
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }
    $rutaFinal = $folderPath . '/ultimo_reporte.csv';

    /*3. Mover el archivo a la carpeta del municipio, sobrescribiendo el
    archivo anterior*/

    move_uploaded_file($rutaTemporal, $rutaFinal);

    //4.- Verificar la última fecha de actualización en la base de datos

    $lastUpdate = $repositorio->obtenerUltimaFechaReporte($municipio);
    $newUpdate = filemtime($rutaFinal); // Fecha de subida del archivo

    /* 5.- Buscar palabras clave en el campo necesidades de ayuda con la
    función strpos NOTA: ESTO SE DEBE HACER POR CADA NECESIDAD ESTABLECIDA*/
    $personas_afectadas=$datos[1];

    $comunicaciones_cortadas=$datos[2];
    if($comunicaciones_cortadas=="SI"){
        $comunicaciones_cortadas=1;
    }else{
        $comunicaciones_cortadas=0;
    }
    $necesidades_ayuda=$datos[3];
    $agua=0;
    if (stripos($necesidades_ayuda, 'agua') !== false) {
        $agua = 1;
    }

    $productos_limpieza=0;
    if (stripos($necesidades_ayuda, 'productos de limpieza') !== false) {
        $productos_limpieza = 1;
    }

    $viveres=0;
    if (stripos($necesidades_ayuda, 'viveres') !== false) {
        $viveres = 1;
    }

    $medicinas=0;
    if (stripos($necesidades_ayuda, 'medicinas') !== false) {
        $medicinas = 1;
    }
    // Asignar a $otros si no se encuentra ninguna palab ra clave
    
    if (
        $agua === 0 && $productos_limpieza === 0 &&
        $viveres === 0 && $medicinas === 0
    ) {
        $otros = $necesidades_ayuda;
    }else{
        $otros="";
    }

    //6.- Insertar o actualizar los datos en la base de datos
    
    $repositorio->guardarEstadoMunicipio(
        $municipio,
        $personas_afectadas,
        $comunicaciones_cortadas,
        $agua,
        $productos_limpieza,
        $viveres,
        $medicinas,
        $otros
    );
    //7.- Cerrar el archivo
    fclose($file);
}
