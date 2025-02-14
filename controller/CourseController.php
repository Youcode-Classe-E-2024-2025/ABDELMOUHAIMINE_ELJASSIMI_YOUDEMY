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



    public function uploadFile($file, $allowedTypes = ['video/mp4', 'application/pdf', 'image/jpeg', 'image/png']) {
        $fileName = basename($file["name"]);
        $fileType = $file["type"];
        $fileTmpName = $file["tmp_name"];
        $fileError = $file["error"];
    
        if (strpos($fileType, 'video') !== false) {
            $targetDir = 'uploads/videos';
        } elseif (strpos($fileType, 'image') !== false) {
            $targetDir = 'uploads/images';
        } elseif ($fileType === 'application/pdf') {
            $targetDir = 'uploads/documents';
        } else {
            return "File type not allowed. Allowed types are: mp4, pdf, jpg, png.";
        }
        $targetFile = $targetDir . '/' . $fileName;

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
    

    public function create($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath,$price){
        $this->CourseModel->createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath,$price);
        header("location: index.php?action=home");
    }

    public function GetAllCourses(){
        return $this->CourseModel->getAll();
    }

    public function Home() {
        $limit = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = max($page, 1);
        $offset = ($page - 1) * $limit;
    
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    
        if (!empty($keyword)) {
            $condition = "title LIKE :keyword OR description LIKE :keyword";
            $params = [':keyword' => '%' . $keyword . '%'];
            $total_records = $this->CourseModel->countFiltered($condition, $params); 
            $courses = $this->CourseModel->getFiltered($condition, $params, $limit, $offset);
        } else {
            $total_records = $this->CourseModel->countAll();
            $courses = $this->CourseModel->getAll('', $limit, $offset);
        }
    
        $total_pages = ceil($total_records / $limit);
        require_once "view/home.php";
    }
    
    

    public function DisplayCourseContent($id){
        $courses = $this->CourseModel->getAll('id = '.$id);
        $student_id = $_SESSION["user_id"];
        $enrolled =$this->CourseModel->AlreadyRolled($student_id,$id);
        $tags = $this->TagModel->GetTagsByCourse($id);
        $teacher = $this->CourseModel->getTeacherByCourse($id);
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

    public function adminStats(){
        $courses = $this->CourseModel->getAll();
        $topCourses =$this->CourseModel->TopCourses();
        $TeacherStats = $this->CourseModel->getTeacherStats();
        $CategoryCours = $this->CourseModel->CoursByCategory();
        require_once "view/adminStats.php";
    }


    public function generateCertificat($course_id,$student_id){
        $Cours = $this->CourseModel->Certificat($course_id,$student_id);
        require_once "view/certificat.php";
    }





}