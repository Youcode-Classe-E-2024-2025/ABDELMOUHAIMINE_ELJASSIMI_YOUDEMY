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

}