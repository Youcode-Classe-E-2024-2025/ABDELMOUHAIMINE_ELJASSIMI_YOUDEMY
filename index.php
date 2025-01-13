<?php
require "controller/UserController.php";

$UserController = new UserController();

$action = $_GET["action"]??'home';

switch($action){
    case "home":
        require_once "view/home.php";
        break;

    case "login":
          require "view/login&register.php";
        break;

    case "register":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        $UserController->register(htmlspecialchars($name),htmlspecialchars($email),htmlspecialchars($password),$role);
        }
        break;

    case "logincheck" :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $UserController->login(htmlspecialchars($email),htmlspecialchars($password));
        }
        break;
    case "logout":
        $UserController->logout();
        break;
}
?>