<?php
include "./analizadorDiscurso.php";
$ruta_destino="./dataset/";
$file_ruta_destino=$ruta_destino.basename($_FILES['archivo']['name']);
$extension=strtolower( pathinfo($file_ruta_destino,PATHINFO_EXTENSION));
$metodo=$_SERVER['REQUEST_METHOD'];
$uploadOk=1;
if($metodo=="POST"){
    if(file_exists($file_ruta_destino)){
        $uploadOk=0;
    }
    if($extension!='txt'/*&&$extension!='json'*/){
        $uploadOk=0;
    }
    if($uploadOk==0){
        echo "Error als ubir archivo </br>";
    }else{
        if(move_uploaded_file($_FILES['archivo']['tmp_name'],$file_ruta_destino)){

            echo "Archivo subido con éxito </br>";
        }else{
        echo"Error alsubir archivo </br>";
    }
}
}
$analizador=new AnalizadorDiscurso();
$texto=file_get_contents($file_ruta_destino);
$analizador->agregarDiscurso($texto);
$palabras_importantes=$analizador->analizar();
print_r($palabras_importantes);
?>