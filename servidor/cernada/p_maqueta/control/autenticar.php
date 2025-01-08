<?php
session_start();
//Si es la primera vez que entra va al form, si ya entrega el form comprobamos
if (isset($_GET['nombreUsuario'])) {
    $usuarioIntroducido=$_GET['nombreUsuario'];
    $passIntroducida=$_GET['pass'];
    require_once '../clases/RepositoryMySQL.php';

    $servername = "mysql";
    $username = "root";
    $password = "1234";
    $dbname = "FLOTA";

    $repositorio = new RepositoryMySQL($servername, $username, $password, $dbname);
    $usuariosAutorizados = $repositorio->findAllAdmins();
    
    $flag=0;
    foreach ($usuariosAutorizados as $admin) {
        $contraseña_verificada = password_verify($passIntroducida, $admin['password']);
        if($admin['id_admin']==$usuarioIntroducido && $contraseña_verificada){
            //Creamos la sesion y vamos de nuevo al menu
            $flag=1;
            $_SESSION['admin']=$admin['id_admin'];
            header('location:../index.html');
        }
    }

    if($flag==0){
        echo 'Usuario NO VALIDO!';
    }
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Autenticar</title>
    </head>

    <body>
        <form action="autenticar.php">
            Nombre: <input type="text" name="nombreUsuario" required>
            Contraseña: <input type="text" name="pass" required>

            <button type="submit">Iniciar Sesion</button>
        </form>
    </body>

    </html>
<?php
}
?>