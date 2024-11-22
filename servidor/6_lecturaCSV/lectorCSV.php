<?php
$rutaDestino="./dataset/";
$rutaDestinoArchivo=$rutaDestino.basename($_FILES['archivoSubido']['name']);

$rutaTemporal=$_FILES['archivoSubido']['tmp_name'];
$metodo=$_SERVER['REQUEST_METHOD'];
//primero movemos el archivo, aunque podría procesarse primero realmente
if($metodo=='POST'){
    if(move_uploaded_file($rutaTemporal,$rutaDestinoArchivo)){
        echo 'Archivo subido correctamente </br>';
    }else{
        echo 'Error al subir archivo </br>';
    }
}
/*Con fopen obtienes un puntero al archivo con r lees(read)*/
$punteroCSV=fopen($rutaDestinoArchivo,'r');

/*Extrae una linea del csv en formato array, se hace antes del bucle
para desecharla porque son los encabezados*/
$datos=fgetcsv($punteroCSV);

while(($datos=fgetcsv($punteroCSV))!==false){
 
    print_r($datos[0].$datos[1]."</br>");
}



?>