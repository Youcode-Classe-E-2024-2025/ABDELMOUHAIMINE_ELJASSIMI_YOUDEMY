<?php 
require_once "model/CourseModel.php";
require_once "model/CategoryModel.php";
require_once "model/TagModel.php";

class CourseController{

     private $CourseModel;
     private $CategoryeModel;
     private $TagModel;
    

     public function __construct(){
        $this->CourseModel = new CourseModel();
        $this->CategoryeModel = new CategoryModel();
        $this->TagModel = new TagModel();

     }


    public function DisplayCourseForm(){
       $categories = $this->CategoryeModel->getAll();
       $tags = $this->TagModel->getAll();
        require_once "view/create-course-form.php";
    }



    public function uploadFile($file, $targetDir, $allowedTypes = ['video/mp4', 'application/pdf', 'image/jpeg', 'image/png']) {
        $fileName = basename($file["name"]);
        $fileType = $file["type"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];

        $targetFile = $targetDir . '/' . $fileName;
    
        if (!in_array($fileType, $allowedTypes)) {
            return "File type not allowed. Allowed types are: mp4, pdf, jpg, png.";
        }
    
        if ($fileError !== UPLOAD_ERR_OK) {
            return "Error uploading the file.";
        }
    
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
    
        if (move_uploaded_file($fileTmpName, $targetFile)) {
            return $targetFile;
        } else {
            return "Error moving the uploaded file.";
        }
    }

    public function create($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath){
        $this->CourseModel->createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath);
        require_once "view/home.php";
    }

    public function GetAllCourses(){
        return $this->CourseModel->getAll();
    }

    public function Home(){
        $courses = $this->CourseModel->getAll();
        require_once "view/home.php";
    }

    public function DisplayCourseContent($id){
        $courses = $this->CourseModel->getAll('id = '.$id);
        require_once "view/CourseDetails.php";
    }

    public function ManageCourse(){
        $courses = $this->CourseModel->getAll('teacher_id = '.$_SESSION["user_id"]);
        require_once "view/ManageCourses.php";
    }

    public function DeleteCourse($id){
         $this->CourseModel->Delete($id);
         header("location: index.php?action=manageCourses");
    }

    public function EditCourse($id){
        $courses = $this->CourseModel->getAll('id = '.$id);
        $categories = $this->CategoryeModel->getAll();
        $tags = $this->TagModel->getAll();
        require_once "view/edit-course-form.php";
    }

    public function CourseEdit($id,$title, $Description, $category, $tags, $videoPath, $documentPath, $ThumbnailPath){
        $this->CourseModel->edit($id,$title, $Description, $category, $tags, $videoPath, $documentPath, $ThumbnailPath);
        header("location: index.php?action=manageCourses");
    }

    public function EnrollCourse($course_id,$student_id){
        $this->CourseModel->Enroll($course_id,$student_id);
        header("location: index.php");
    }

    public function MesCours($student_id){
        $courses = $this->CourseModel->Cours($student_id);
        require_once "view/MesCours.php";
    }

    public function TeacherStats($teacher_id){
        $stats = $this->CourseModel->teacherStatsics($teacher_id);
        require_once "view/TeacherStatistics.php";
    }

    public function manageContent(){
        $courses = $this->CourseModel->getAll();
        $categories = $this->CategoryeModel->getAll();
        $tags = $this->TagModel->getAll();
        require_once "view/ContentManagement.php";
    }


}