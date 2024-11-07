<?php

if(isset($_FILES['archivo_csv'])){
    
    $rutaDestino="../uploads/";
    $rutaDestinoArchivo=$rutaDestino.basename($_FILES['archivo_csv']['name']);
    $rutaTemporal=$_FILES['archivo_csv']['tmp_name'];

    $punteroCSV=fopen($rutaTemporal,'r');
    $datos=fgetcsv($punteroCSV);

    if(move_uploaded_file($rutaTemporal,$rutaDestinoArchivo)){
        echo 'Archivo subido correctamente </br>';
    }else{
        echo 'Error al subir archivo </br>';
    }
}


