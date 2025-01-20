<?php

require_once "config.php";

class CategoryModel extends Database{

    protected $pdo;

    public function __construct(){
        $this->pdo = parent::getConnection();
    }
    
    public function getAll()
    {
        $query = "SELECT * FROM categories";
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($categoryname){
        $sql = "INSERT INTO categories (name)  values (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["name"=>$categoryname]);
    }

    public function delete($categoryId){
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$categoryId]);
    }

    
}