<?php

require_once "config.php";

class UserModel{
    
    private $username;
    private $email;
    private $password;
    private $role;
    private $status;

    protected $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function create($username, $email, $password, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }
    
    public function getAll($condition = '')
    {
        $query = "SELECT * FROM users";
        if(!empty($condition)){
            $query .= " WHERE $condition";
        }
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function login($email, $password)
    {
        $user = $this->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function active($id){
        $sql = "UPDATE users SET status = 'active' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$id]);
    }

}