<?php

require_once "config.php";

class CourseModel{
    protected $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath){
        $sql = "INSERT INTO courses (title, description, category_id, teacher_id, video_path, document_path, thumbnail) 
                VALUES (:title, :description, :category_id, :teacher_id, :video_path, :document_path, :thumbnail)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "title" => $title,
            "description" => $Description,
            "category_id" => $category,
            "teacher_id" => $teacher_id,
            "video_path" => $videoPath,
            "document_path" => $documentPath,
            "thumbnail" => $ThumbnailPath
        ]);

        $course_id = $this->pdo->lastInsertId();
        $sql = "INSERT INTO course_tags (course_id,tag_id) values (:course_id,:tag_id)";
        $stmt =$this->pdo->prepare($sql);
        foreach ($tags as $tag){
            $stmt->execute(['course_id'=>$course_id,'tag_id'=>$tag]);
        }

    }
    public function getAll($condition = '') {
        $sql = "SELECT c.*,  cat.name AS category_name, COUNT(e.student_id) AS enrolled_students FROM  courses c JOIN categories cat  
                 ON c.category_id = cat.id LEFT JOIN enrollments e  ON c.id = e.course_id";
    
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        $sql .= " GROUP BY c.id, cat.name";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function Delete($id){
        $sql="DELETE FROM courses WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$id]);
    }
    public function edit($id, $title, $description, $category, $tags, $videoPath, $documentPath, $thumbnailPath) {
        try {
    
            $sql = "UPDATE courses SET title = :title, video_path = :videoPath,  document_path = :documentPath,  thumbnail = :thumbnail,  description = :description, category_id = :category WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                "id" => $id,
                "title" => $title,
                "description" => $description,
                "category" => $category,
                "videoPath" => $videoPath,
                "documentPath" => $documentPath,
                "thumbnail" => $thumbnailPath
            ]);
    
            $sql = "DELETE FROM course_tags WHERE course_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id" => $id]);
    

            $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $this->pdo->prepare($sql);
            foreach ($tags as $tag) {
                $stmt->execute(["course_id" => $id, "tag_id" => $tag]);
            }
    
        } catch (PDOException $e) {
            echo "Error updating course: " . $e->getMessage();
        }
    }
    
    public function Enroll($course_id,$student_id){
        $sql = "INSERT INTO enrollments (student_id,course_id) values (:student_id,:course_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["student_id"=>$student_id,"course_id"=>$course_id]);
    }

    public function Cours($student_id){
        $sql = " SELECT c.*, cat.name AS category_name FROM  courses c JOIN  enrollments e  ON c.id = e.course_id 
        JOIN categories cat ON c.category_id = cat.id WHERE e.student_id = :student_id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}