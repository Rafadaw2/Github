<?php
$rutaDestino="./dataset/";
$rutaDestinoArchivo=$rutaDestino.basename($_FILES['archivoSubido']['name']);
$rutaTemporal=$_FILES['archivoSubido']['tmp_name'];
$metodo=$_SERVER['REQUEST_METHOD'];
if($metodo=='POST'){
    if(move_uploaded_file($rutaTemporal,$rutaDestinoArchivo)){
    echo 'Archivo subido correctamente </br>';
    }else{
        echo 'Error subiendo archivo </br>';
    }
}else{
    echo 'Error subiendo archivo </br>';
}

/*Primero extraemos los datos del json en una cadena*/
$cadenaJson= file_get_contents($rutaDestinoArchivo);

/*Luego con la función json_decode interpretamos la cadena y la 
transformamos en un array u objeto. Si el segundo atributo de la función es
false o se omite y en un array si el segundo atributo es true*/

//Metodo 1, tratado como objeto:


$objetosJson= json_decode($cadenaJson);
$librosObj=$objetosJson->libros;
foreach($librosObj as $libro){
    $titulo=$libro->titulo;
    $autores=$libro->autor;
    $listaAutores="";
    $contador=count($autores);
    foreach($autores as $autor ){
        $contador--;
        $separador="";
        if($contador!=0){
            $separador=", ";
        }else{
            $separador="";
        }
        $listaAutores.=$autor.$separador;
        
    }
    echo 'Titulo: '.$titulo.'. Autor o autores: '.$listaAutores.'. </br>';
}

//Metodo 2, tratado como array:

$arrayJson=json_decode($cadenaJson,true);
$librosArr=$arrayJson['libros'];
foreach($librosArr as $libro){
    $titulo=$libro['titulo'];
    $autores=$libro['autor'];
    $listaAutores="";
    $contador=count($autores);
    foreach($autores as $autor ){
        $contador--;
        $separador="";
        if($contador!=0){
            $separador=", ";
        }else{
            $separador="";
        }
        $listaAutores.=$autor.$separador;
        
    }
    echo 'Titulo: '.$titulo.'/ Autor o autores: '.$autor.'. </br>';
}
?>