<?php
require "controller/UserController.php";
require "controller/CourseController.php";

$UserController = new UserController();
$CourseController = new CourseController();

session_start();

$action = $_GET["action"]??'home';

switch($action){
    case "home":
        $CourseController->Home();
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

        case "addCourse" : 
            $CourseController->DisplayCourseForm();
            break;

        case 'createCourse':
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $title = htmlspecialchars($_POST["title"]);
                $Description = htmlspecialchars($_POST["description"]);
                $price = floatval($_POST["price"]); // Ensure price is numeric
                $category = intval($_POST["category"]);
                $tags = $_POST['tags'];
                $teacher_id = intval($_SESSION["user_id"]);
    
                $videoFile = $_FILES['video_file'];
                $videoPath = null;
                if ($videoFile['error'] === UPLOAD_ERR_OK) {
                    $videoPath = $CourseController->uploadFile($videoFile, 'uploads/videos');
                }
            
                $documentFile = $_FILES['document_file'];
                $documentPath = null;
                if ($documentFile['error'] === UPLOAD_ERR_OK) {
                    $documentPath = $CourseController->uploadFile($documentFile, 'uploads/documents');
                }
    
                $ThumbnailFile = $_FILES['thumbnail_file'];
                $ThumbnailPath = null;
                if ($ThumbnailFile['error'] === UPLOAD_ERR_OK) {
                    $ThumbnailPath = $CourseController->uploadFile($ThumbnailFile, 'uploads/photo');
                }
                $CourseController->create($title, $Description, $category, $tags, $teacher_id, $videoPath, $documentPath, $ThumbnailPath);           
             }
            break;

        case "CourseDetails" : 
            $id = $_GET["id"];
            $CourseController->DisplayCourseContent($id);
            break;
}
?>