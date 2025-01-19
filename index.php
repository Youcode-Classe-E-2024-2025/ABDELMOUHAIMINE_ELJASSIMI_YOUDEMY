<?php
session_start();
require "controller/UserController.php";
require "controller/CourseController.php";
require "controller/TagController.php";
require "controller/CategoryController.php";


$UserController = new UserController();
$CourseController = new CourseController();
$TagController = new TagController();
$CategoryController = new CategoryController();


$action = $_GET["action"]??'home';

switch($action){
    case "home":
        $CourseController->Home();
        break;

    case "login":
          require_once "view/login&register.php";
          
        break;

    case "register":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token validation failedddddd");
            }
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = $_POST["role"];
            $UserController->register(htmlspecialchars($name),htmlspecialchars($email),htmlspecialchars($password),$role);
        }
        break;

    case "logincheck" :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token validation failed");
            }
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

                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die("CSRF token validation failed");
                }

                $title = htmlspecialchars($_POST["title"]);
                $Description = htmlspecialchars($_POST["description"]);
                $price = $_POST["price"];
                $category = $_POST["category"];
                $tags = $_POST['tags'];
                $teacher_id = $_SESSION["user_id"];
    
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
                $CourseController->create($title, $Description, $category, $tags, $teacher_id, $videoPath, $documentPath, $ThumbnailPath,$price);           
             }
            break;

        case "CourseDetails" : 
            $id = $_GET["id"];
            $CourseController->DisplayCourseContent($id);
            break;

        case "manageCourses" :
            $CourseController->ManageCourse();
            break;
        case "editCourse" : 
            $id = $_POST['id'];
            $CourseController->EditCourse($id);
            break;
        case "deleteCourse" : 
            $id = $_POST['id'];
            $CourseController->DeleteCourse($id);
            break;
        case "CourseEdit" : 
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token validation failed");
            }
                $title = htmlspecialchars($_POST["title"]);
                $Description = htmlspecialchars($_POST["description"]);
                $category = $_POST["category"];
                $tags = $_POST['tags'];
                $id = $_POST["id"];

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

                $CourseController->CourseEdit($id,$title, $Description, $category, $tags, $videoPath, $documentPath, $ThumbnailPath);  
                break;

            case "enroll" :
                $course_id = $_POST["id"];
                $student_id = $_SESSION["user_id"];
                $CourseController->EnrollCourse($course_id,$student_id);
                break;
            case "mesCours" :
                $student_id = $_SESSION["user_id"];
                $CourseController->MesCours($student_id);
                break;
            case "TeacherStats" : 
                $teacher_id = $_SESSION["user_id"];
                $CourseController->TeacherStats($teacher_id);
                break;
            case "manageUsers" : 
                $UserController->ManageUsers();
                break;
            case "activeUser" : 
                $id = $_POST["user_id"];
                $status = $_POST["status"];
                $UserController->ChangeStatus($id,$status);
                break;
            case "suspendUser" : 
                $id = $_POST["user_id"];
                $status = $_POST["status"];
                $UserController->ChangeStatus($id,$status);
                break;
            case "deleteUser" : 
                $id = $_POST["user_id"];
                $status = $_POST["status"];
                $UserController->ChangeStatus($id,$status);
                break;
            case "suspended" : 
                require_once "view/suspendedAccount.php";
                break;
            case "deleted" : 
                require_once "view/deletedAccount.php";
                break;
            case "registerDeleted" : 
                $UserController->logout();
                break;
            case "returnHome" : 
                $UserController->returnHome();
                break;
            case "manageContent" :
                $CourseController->manageContent();
                break;
            case "CreateTag" :
                $tagName = $_POST["tagname"];
                $TagController->CreateTag($tagName);
                break;
            case "DeleteTag" : 
                $tagId = $_GET["id"];
                $TagController->DeleteTag($tagId);
                break;
            case "createCategory":
                $categoryname = $_POST["categoryname"];
                $CategoryController->CreateCategory($categoryname);
                break;
            case "deleteCategory":
                $categoryId = $_GET["id"];
                $CategoryController->DeleteCategory($categoryId);
                break;
            case "addBulkTag" : 
                $tags = $_POST["tags"];
                $course = $_POST["course"];
                $TagController->BulkTag($tags,$course);
                break;
            case "adminstats" :
                $CourseController->adminStats();
                break;
            case "generateCertificat" : 
                $course_id = $_GET["id"];
                $student_id = $_SESSION["user_id"];
                $CourseController->generateCertificat($course_id,$student_id);
                break;
}
?>