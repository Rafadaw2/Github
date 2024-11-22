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

/*Primero extraemos los datos del json en una cadena con 
file_get_contents pasandole la ruta donde esta*/
$cadenaJson= file_get_contents($rutaDestinoArchivo);

/*Luego con la función json_decode interpretamos la cadena y la 
transformamos en un array u objeto. Si el segundo atributo de la función es
false o se omite y en un ARRAY si el segundo atributo es TRUE
CON TRUE ARRAY
SIN NADA OBJETO*/

//Metodo 1, se trata como objeto al omitir el segundo parametro:

$objetosJson= json_decode($cadenaJson);
/*Aqui estamos arriba del todo para entrar a cada libro
debemos bajar un nivel*/
$librosObj=$objetosJson->libros;
/*Una vez en el nivel correcto pordemos recorrerlo, tambien podriamos haber accedido desde el bucle directamente
foreach($objetosJson as $librosObj->libro*/

foreach($librosObj as $libro){
    $titulo=$libro->titulo;
    $autores=$libro->autor;
    //Implode me permite concatenar todos los elementos de un array con cierto separador
    $listaAutores=implode(", ",$autores);
    $contador=count($autores);
    /*foreach($autores as $autor ){
        $contador--;
        $separador="";
        if($contador!=0){
            $separador=", ";
        }else{
            $separador="";
        }
        $listaAutores.=$autor.$separador;
        
    }*/
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