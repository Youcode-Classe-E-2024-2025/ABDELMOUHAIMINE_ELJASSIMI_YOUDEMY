<?php

require_once "config.php";

class UserModel extends Database{
    
    private $username;
    private $email;
    private $password;
    private $role;
    private $status;

    protected $pdo;

    public function __construct(){
        $this->pdo = parent::getConnection();
    }

    public function create($username, $email, $password, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $status = ($role === 'teacher') ? 'suspended' : 'active';
    
        $query = "INSERT INTO users (username, email, password, role, status) 
                  VALUES (:username, :email, :password, :role, :status)";
        $stmt = $this->pdo->prepare($query);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':status', $status);

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

    public function ChangeStatusUser($id,$status){
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["status"=>$status,"id"=>$id]);
    }

}