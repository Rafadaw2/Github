<?php
session_start();

if(isset($_SESSION['admin'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cargarNuevosDatosFlota.php" enctype="multipart/form-data" method="POST">
        <h1>CARGAR NUEVOS VEHICULOS</h1>
        <input type="file" name="file">
        <button type="submit">Subir</button>
    </form>
</body>
</html>

<?php 
}else{
   header('location: autenticar.php');
}