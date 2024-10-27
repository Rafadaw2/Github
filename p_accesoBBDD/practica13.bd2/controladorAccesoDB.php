<?php
require_once "RPGRepositoryMYSQL";
require_once "RPGRepositoryMONGODB";
$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "rpg_game";    // Nombre de la base de datos

try{
    $repositorio= new RPGRepositoryMYSQL($servername,$dbname,$username,$password)
}catch (PDOException $e) {
    echo 'Erro r
    de conexión: ' . $e->getMessage();
    }