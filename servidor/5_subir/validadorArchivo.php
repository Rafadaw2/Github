<?php
include "./analizadorDiscurso.php";
$ruta_destino="./dataset/";

/*El archivo una vez subido se guarda en la superglobal $_FILES, que es un array
asociativo, se creara una posición con el nombre del html y dentro habrá diferentes valores
como la posicion name que tendrá el nombre del archivo o tmp_name que tendrá la ruta del mismo.
* $_FILES['file']['type'] - The mime type of the file.
* $_FILES['file']['size'] - The size, in bytes, of the
uploaded file.
* $_FILES['file']['tmp_name'] - The temporary filename of the
file in which the uploaded file was stored on the server.
*/

$file_ruta_destino=$ruta_destino.basename($_FILES['archivo']['name']);
//obteniendo la extensión podrías verificar despues que sea la extensión que esperas
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