<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: autenticar.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de retraso</title>
</head>
<body>
    <h3>Formulario de inclusion de nuevos conductores y vehiculos</h3>
    <form action="./cargarNuevosDatosFlota.php" method="post" enctype="multipart/form-data">
        <label for="archivo">Subir datos en JSON</label>
        <input type="file" name="archivo" id="archivo" required accept="application/json">
        <input type="submit" value="Subir">
    </form>
</body>
</html>
