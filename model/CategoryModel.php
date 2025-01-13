<?php

require_once "config.php";

class CategoryModel{

    protected $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->getConnection();
    }
    
    public function getAll()
    {
        $query = "SELECT * FROM categories";
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    
}