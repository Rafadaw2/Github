<?php
require_once 'vistaTablero.php';
require_once 'RepositoryMySQL.php';

$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "game_matrix";    // Nombre de la base de datos
$repositorio=new RepositoryMySQL($servername,$dbname,$username,$password);
$repositorio=new RepositoryMySQL($servername,$dbname,$username,$password);
$partidasGuardadas=$repositorio->findAllScores();
$vista = new VistaTablero();
$vista->mostrarPartidas($partidasGuardadas);
