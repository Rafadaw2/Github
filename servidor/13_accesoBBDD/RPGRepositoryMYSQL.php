<?php
require '../vendor/autoload.php';
require_once './RPGrepositoryInterface.php';

class RPGRepositoryMYSQL implements RPGRepositoryInterface{
    private $con;

    public function __construct($servername, $dbname, $username,$password) {
        $this->con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function findQuestByName(string $name):array{
        $stmt=$this->con->prepare("
        SELECT q.title, q.description, q.reward, q.is_completed
        FROM quests q
        JOIN character_quests cq ON q.id = cq.quest_id
        JOIN characters c ON cq.character_id = c.id
        WHERE c.name = :characterName");

        $stmt->bindParam(":characterName",$name);
        $stmt->execute();
        //fetchAll devuelve varias filas y fetch una sola
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findAllQuests():array
    {
        //Cuando no tengo parametros que sustituir se hacer asi
        $sentencia="SELECT * FROM quests";
        $stmt=$this->con->query($sentencia);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findAllCharacters():array
    {
        $sentencia="SELECT * FROM characters";
        $stmt=$this->con->query($sentencia);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findQuestsByCharacterName(string $characterName):array
    {
       $sentencia="SELECT * 
                    FROM quests q
                    join character_quests cq on q.id=cq.quest_id
                    join characters c on cq.character_id=c.id
                    where c.name=:characterName";
        $stmt=$this->con->prepare($sentencia);
        $stmt->bindParam(":characterName",$characterName);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findCharacterByName(string $name):array
    {
        $sentencia="SELECT * FROM characters c where c.name=:characterName";
        $stmt=$this->con->prepare($sentencia);
        $stmt->bindParam(":characterName", $name);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addCharacter($name, $level, $experience, $health)
    {
        $sentencia="INSERT INTO characters (name, level, experience, health) VALUES
        (:name, :level, :experience,:health) ";
        $stmt=$this->con->prepare($sentencia);
        $stmt->execute(["name"=>$name,"level"=>$level,"experience"=>$experience,"health"=>$health]);
        
    }
}
?>
