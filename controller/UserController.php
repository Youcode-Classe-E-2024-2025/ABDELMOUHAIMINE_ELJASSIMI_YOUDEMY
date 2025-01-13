<?php
require_once "model/UserModel.php";

class UserController
{
    private $userModel;

    public function __construct()
    {
        
        $this->userModel = new UserModel();
    }
    public function register($username, $email, $password, $role)
    {
        if ($this->userModel->create($username, $email, $password, $role)) {
            require_once "view/login&register.php";
        }
    }
    public function listUsers()
    {
        return $this->userModel->getAll();
    }
}
