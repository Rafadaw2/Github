<?php
require_once "./RPGRepositoryMYSQL.php";
/*require_once "./RPGRepositoryMONGODB.php";*/
$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "rpg_game";    // Nombre de la base de datos

try{
    $repositorio= new RPGRepositoryMYSQL($servername,$dbname,$username,$password);
    if($_SERVER["REQUEST_METHOD"] && empty($_GET)){
        echo "<h1>Información del juego: LISTA DE PERSONAJES Y 
        LISTA DE DESAFIOS</h1>";
        echo "<h3>Lista de personajes:</h3>";
        $personajes=$repositorio->findAllCharacters();

        foreach($personajes as $personaje){
            echo $personaje['name']."</br>";
        }
        echo "<h3>Lista de misiones:</h3>";
        $misiones=$repositorio->findAllQuests();
        foreach($misiones as $mision){
            echo $mision['title']. ". Completada: ".$mision['is_completed']."</br>";
        }
    
    }else if(isset($_GET['characterName'])){
        $misionesPersonaje=$repositorio->findQuestsByCharacterName($_GET['characterName']);
        echo "Las misiones del personaje ".$_GET['characterName']." son:</br>";
        foreach($misionesPersonaje as $mision){
            echo $mision['title']."</br>";
        }
    }

}catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    }