<?php

require_once "config.php";

class TagModel extends Database{

    protected $pdo;
    
    public function __construct(){
        $this->pdo = parent::getConnection();
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


    public function GetTagsByCourse($course_id){
        $sql = "SELECT t.* FROM tags t JOIN course_tags ct ON t.id = ct.tag_id and ct.course_id = :course_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["course_id"=>$course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}