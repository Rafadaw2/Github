<?php
$rutaDestino="./dataset/";
$rutaDestinoArchivo=$rutaDestino.basename($_FILES['archivoSubido']['name']);

$rutaTemporal=$_FILES['archivoSubido']['tmp_name'];
$metodo=$_SERVER['REQUEST_METHOD'];

if($metodo=='POST'){
    if(move_uploaded_file($rutaTemporal,$rutaDestinoArchivo)){
        echo 'Archivo subido correctamente </br>';
    }else{
        echo 'Error al subir archivo </br>';
    }
}
/*COn fopen obtienes un puntero al archivo*/
$punteroCSV=fopen($rutaDestinoArchivo,'r');
/*Extrae una linea del csv*/
$datos=fgetcsv($punteroCSV);

while(($datos=fgetcsv($punteroCSV))!==false){
 
    print_r($datos[0].$datos[1]."</br>");
}



?>