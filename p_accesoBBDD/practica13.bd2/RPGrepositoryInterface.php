<?php
interface RPGRepositoryInterface{

public function __construct($servername, $dbname, $username,
$password);
// Método para encontrar una quest por su nombre
public function findQuestByName(string $name):array;
// Método para obtener todas las quests
public function findAllQuests():array;
// Método para obtener todos los personajes
public function findAllCharacters():array;
// Método para obtener las quests asociadas a un personaje por su ID
public function findQuestsByCharacterName(string $characterName):array;
// Método para encontrar un personaje por su nombre
public function findCharacterByName(string $name);
// Método para añadir un personaje
public function addCharacter(string $name,int $level,int $experience,int $health);

}


?>