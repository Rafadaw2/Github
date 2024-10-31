<?php
class RepositoryMySQL{
    private $con;
    public function __construct($servername, $dbname, $username,$password) {
        $this->con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function saveGame($score) {
        $sentencia="INSERT INTO game (score) VALUES
        (:score) ";
        $stmt=$this->con->prepare($sentencia);
        $stmt->bindParam(":score", $name);
        $stmt->execute();

    }
    public function findAllScores() :array {
        $sentencia="SELECT * FROM quests";
        $stmt=$this->con->query($sentencia);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}