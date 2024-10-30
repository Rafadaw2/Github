<?php
require_once "./VistaHTML.php";
require_once "./RPGRepositoryMYSQL.php";
/*require_once "./RPGRepositoryMONGODB.php";*/
$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "rpg_game";    // Nombre de la base de datos

try{
    $repositorio= new RPGRepositoryMYSQL($servername,$dbname,$username,$password);
    $vista= new VistaHTML();
    if(isset($_GET['action']) && $_GET['action']==1){
        
        $personajes=$repositorio->findAllCharacters();
        $vista->mostrarCharacters($personajes);

        $misiones=$repositorio->findAllQuests();
        $vista->mostrarQuests($misiones);
    
    }else if(isset($_GET['action']) && $_GET['action']==2){
        $misionesPersonaje=$repositorio->findQuestsByCharacterName($_GET['characterName']);
        $vista->mostrarQuestsDePersonaje($_GET['characterName'],$misionesPersonaje);
    }else if(isset($_GET['action']) && $_GET['action']==3){
        $name=$_GET['name'];
        $level=$_GET['level'];
        $experience=$_GET['experience'];
        $health=$_GET['health'];
        $repositorio->addCharacter($name,$level,$experience,$health);
        $vista->mostrarMensaje("Personaje añadido correctamente");
    }

}catch (PDOException $e) {
    $vista->mostrarError($e->getMessage()) ;
    }