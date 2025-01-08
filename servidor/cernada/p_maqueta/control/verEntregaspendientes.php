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

if (isset($_SESSION['admin'])) {
    if (isset($_POST['conductor']) && !empty($_POST['conductor'])) {
        $id = $repositorio->buscarPorConductor($_POST['conductor']);
        $vista->mostrarEntregasPendientes($id);
        setcookie('busquedaC', $_POST['conductor'], time() + 3600);
    } else if (isset($_POST['vehiculo'])) {
        $id = $repositorio->buscarPorVehiculo($_POST['vehiculo']);
        $vista->mostrarEntregasPendientes($id);
        setcookie('busquedaV', $_POST['vehiculo'], time() + 3600);
    } else if (isset($_COOKIE['busquedaC'])) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>
            <form action="verEntregaspendientes.php" method="post">
                <h1>Consulta de Entregas Pendientes</h1>
                Conductor(ID): <input type="text" name="conductor" <?php echo "value={$_COOKIE['busquedaC']}" ?>><br>
                Vehiculo(ID): <input type="text" name="vehiculo">
                <button type="submit">Subir</button>
            </form>
        </body>

        </html>
    <?php
    } else if (isset($_COOKIE['busquedaV'])) {
        ?>
                <!DOCTYPE html>
                <html lang="en">
        
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
        
                <body>
                    <form action="verEntregaspendientes.php" method="post">
                        <h1>Consulta de Entregas Pendientes</h1>
                        Conductor(ID): <input type="text" name="conductor"><br>
                        Vehiculo(ID): <input type="text" name="vehiculo" <?php echo "value={$_COOKIE['busquedaV']}" ?> >
                        <button type="submit">Subir</button>
                    </form>
                </body>
        
                </html>
            <?php
            } else {


    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>
            <form action="verEntregaspendientes.php" method="post">
                <h1>Consulta de Entregas Pendientes</h1>
                Conductor(ID): <input type="text" name="conductor"><br>
                Vehiculo(ID): <input type="text" name="vehiculo">
                <button type="submit">Subir</button>
            </form>
        </body>

        </html>

<?php
    }
} else {
    header('location:autenticar.php');
}
