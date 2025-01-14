<?php

require_once "config.php";

class TagModel{

    protected $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM tags";
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($tagName){
        $sql = "INSERT INTO tags (name)  values (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["name"=>$tagName]);
    }

    public function delete($tagId){
        $sql = "DELETE FROM tags WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$tagId]);
    }
}