<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';
$vista = new VistaHTML();
$servername = "mysql";
$username = "root";
$password = "1234";
$dbname = "FLOTA";

$repositorio = new RepositoryMySQL($servername, $username, $password, $dbname);

if (isset($_SESSION['admin']) && !isset($_POST['localidad'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <form action="procesarRetraso.php" method="post">
            Localidad: <input type="text" name="localidad">
            <button type="submit">Aplicar Retraso</button>
        </form>
    </body>

    </html>

<?php
} else if (isset($_POST['localidad'])) {
    $repositorio->retrasoPorLocalidad($_POST['localidad']);
    echo 'RETRASO REALIZADO!';
} else {
    header('location: autenticar.php');
}
