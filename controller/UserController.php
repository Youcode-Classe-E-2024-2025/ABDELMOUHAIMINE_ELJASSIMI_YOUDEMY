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
            header("location: index.php?action=login");
        }
    }
    public function listUsers()
    {
        return $this->userModel->getAll();
    }

    public function login($email, $password)
    {   if($this->userModel->login($email, $password) !== false){
        $user = $this->userModel->login($email, $password);
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION["user_role"]=$user["role"];
        $_SESSION["user_status"]=$user["status"];
        header('location: index.php');
    }else{
        header("location: index.php?action=login&valide=false");
    }
    }
    public function logout(){
        session_unset();
        session_destroy();
        header("location: index.php?action=login");
    }
    public function returnHome(){
        session_unset();
        session_destroy();
        header("location: index.php?action=home");
    }
    public function ManageUsers(){
        $users = $this->userModel->getAll("role != 'admin'");
        require_once "view/UserManagement.php";
    }

    public function ChangeStatus($id,$status){
        $this->userModel->ChangeStatusUser($id,$status);
        header("location: index.php?action=manageUsers");
    }


}
