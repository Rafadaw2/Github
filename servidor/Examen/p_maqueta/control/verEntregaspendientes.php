<?php
require "../clases/RepositoryMySQL.php";
require "../clases/VistaHTML.php";

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: autenticar.php');
    exit;
}

$servername = "mysql_examen";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "FLOTA";    // Nombre de la base de datos

$repositorio = new RepositoryMYSQL(
    $servername,
    $dbname,
    $username,
    $password
);
$vista = new VistaHTML();

/*if (isset($_COOKIE['buscarPorConductor'])) {
    setcookie("buscarPorConductor", '', time() - 3600);
}
if (isset($_COOKIE['buscarPorVehiculo'])) {
    setcookie("buscarPorVehiculo", '', time() - 3600);
}
*/

if (isset($_POST['id_conductor'])) {
    if (!empty($_POST['id_conductor']) && empty($_POST['id_vehiculo'])) {
        //consultar por conductor
        $id = $_POST['id_conductor'];
        $pendientes = $repositorio->obtenerPendientesConductor($id);
        //mostrar
        $vista->mostrarEntregasPendientes($pendientes);
        if (isset($_COOKIE['buscarPorConductor'])) {
            $_COOKIE['buscarPorConductor'] = $id;
        } else {
            setcookie("buscarPorConductor", $id, time() + 3600);
        }
    } else if (empty($_POST['id_conductor']) && !empty($_POST['id_vehiculo'])) {
        //consular por vehiculo
        $id = $_POST['id_vehiculo'];
        $pendientes = $repositorio->obtenerPendientesVehiculo($id);
        //mostrar
        $vista->mostrarEntregasPendientes($pendientes);
        if (isset($_COOKIE['buscarPorVehiculo'])) {
            $_COOKIE['buscarPorVehiculo'] = $id;
        } else {
            setcookie("buscarPorVehiculo", $id, time() + 3600);
        }
    } else if (!empty($_POST['id_conductor']) && !empty($_POST['id_vehiculo'])) {
        //consultar por conductor
        $id = $_POST['id_conductor'];
        $pendientes = $repositorio->obtenerPendientesConductor($id);
        //mostrar
        $vista->mostrarEntregasPendientes($pendientes);
        if (isset($_COOKIE['buscarPorConductor'])) {
            $_COOKIE['buscarPorConductor'] = $id;
        } else {
            setcookie("buscarPorConductor", $id, time() + 3600);
        }
    } else {
        echo "Debe introducir un parametro";
    }
}else{

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>

<body>
    <h3>Consulta de Entregas Pendientes</h3>
    <form action="./verEntregasPendientes.php" method="post">
        <label for="id_conductor">Conductor (ID)</label>
        <input type="text" name="id_conductor" id="id_conductor" value="<?php if(isset($_COOKIE['buscarPorConductor'])){echo "{$_COOKIE['buscarPorConductor']}";} ?>">
        <label for="id_vehiculo">o Vehiculo (ID)</label>
        <input type="text" name="id_vehiculo" id="id_vehiculo" value="<?php if(isset($_COOKIE['buscarPorVehiculo'])){echo "{$_COOKIE['buscarPorVehiculo']}";} ?>">
        <input type="submit" value="Consultar">
    </form>
</body>

</html>
<?php }