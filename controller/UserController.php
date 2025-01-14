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

    public function login($email, $password)
    {
        $user = $this->userModel->login($email, $password);
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION["user_role"]=$user["role"];
        header('location: index.php');
    }
    public function logout(){
        session_unset();
        session_destroy();
        require_once "view/login&register.php";
    }

    public function ManageUsers(){
        $users = $this->userModel->getAll("role != 'admin'");
        require_once "view/UserManagement.php";
    }

    public function activeUser($id){
        $this->userModel->active($id);
        header("location: index.php?action=manageUsers");
    }


}
