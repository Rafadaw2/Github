<?php
require '../vendor/autoload.php';
require_once 'RPGRepositoryInterface.php';

class RPGRepositoryMYSQL implements RPGRepositoryInterface{
    private $con;

    public function __construct($servername, $dbname, $username,$password) {
        $this->con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function findQuestByName(string $name){
        $stmt=$this->con->prepare("
        SELECT q.title, q.description, q.reward, q.is_completed
        FROM quests q
        JOIN character_quests cq ON q.id = cq.quest_id
        JOIN characters c ON cq.character_id = c.id
        WHERE c.name = :characterName");

        $stmt->bindParam(":characterName",$name);
        $stmt->execute();

        $quests=$stmt->fetchAll(PDO::FETCH_ASSOC);

         // Mostrar el nombre del personaje
        echo "<h1>Misiones de $name</h1>";
    }
    public function findAllQuests()
    {
        //Cuando no tengo parametros que sustituir se hacer asi
        $sentencia="SELECT * FROM quests";
        $stmt=$this->con->query($sentencia);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findAllCharacters()
    {
        $sentencia="SELECT * FROM characters";
        $stmt=$this->con->query($sentencia);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findQuestsByCharacterName(string $characterName)
    {
       $sentencia="SELECT q* 
                    FROM quests q
                    join character_quests cq on q.id=cq.quest_id
                    join character c on cq.character_id=c.id
                    where c.name=:characterName";
        $stmt=$this->con->prepare($sentencia);
        $stmt->bindParam(":characterName",$characterName);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findCharacterByName(string $name)
    {
        $sentencia="SELECT * FROM characters c where c.name=:characterName";
        $stmt=$this->con->prepare($sentencia);
        $stmt->bindParam(":characterName", $name);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
