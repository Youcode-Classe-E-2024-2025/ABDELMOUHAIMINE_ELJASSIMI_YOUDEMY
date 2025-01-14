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

    public function InsertBulkTag($tags,$course){
        $sql="INSERT IGNORE INTO course_tags (course_id,tag_id) values (:course_id,:tag_id)";
        $stmt = $this->pdo->prepare($sql);
        foreach ($tags as $tag){
            $stmt->execute(['course_id'=>$course,'tag_id'=>$tag]);
        }
    }
}