<?php
require "../clases/RepositoryMySQL.php";


session_start();

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

if(isset($_POST['usuario'])){
    $usuario=$_POST['usuario'];
    $contraseña=$_POST['password'];
    $passwordDB=$repositorio->autenticarUsuario($usuario);
    if($passwordDB!=-1){
        if(password_verify($contraseña, $passwordDB['password'])){
            $_SESSION['usuario']=$usuario;
            header("Location: ../index.html");
            exit;
        }else{
            echo "<p>Las credenciales no son correctas</p>
            <a href='../index.html'>Volver</a>";
        }
    }else{
        echo "<p>El usuario no es administrador</p>
        <a href='../index.html'>Volver</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="./autenticar.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario">
        </br>
        <label for="password">Contraseña:</label>
        <input type="text" name="password" id="password">
        </br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>