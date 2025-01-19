<?php

require_once "config.php";

abstract class BaseCourseModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    abstract public function createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath,$price);
    abstract public function getAll($condition = '', $limit = null, $offset = null);
}

class CourseModel extends BaseCourseModel{

    public function __construct() {
        $database = new Database();
        parent::__construct($database->getConnection());
    }

    public function createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath,$ThumbnailPath,$price){
        $sql = "INSERT INTO courses (title, description, category_id, teacher_id, video_path, document_path, thumbnail,price) 
                VALUES (:title, :description, :category_id, :teacher_id, :video_path, :document_path, :thumbnail,:price)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "title" => $title,
            "description" => $Description,
            "category_id" => $category,
            "teacher_id" => $teacher_id,
            "video_path" => $videoPath,
            "document_path" => $documentPath,
            "thumbnail" => $ThumbnailPath,
            "price"=>$price
        ]);

        $course_id = $this->pdo->lastInsertId();
        $sql = "INSERT INTO course_tags (course_id,tag_id) values (:course_id,:tag_id)";
        $stmt =$this->pdo->prepare($sql);
        foreach ($tags as $tag){
            $stmt->execute(['course_id'=>$course_id,'tag_id'=>$tag]);
        }

    }

    
    public function getAll($condition = '', $limit = null, $offset = null) {
          if(!empty($_SESSION["user_id"])){ $studnet_id = $_SESSION["user_id"];};
        $sql = "SELECT c.*, cat.name AS category_name, COUNT(e.student_id) AS enrolled_students 
                FROM courses c 
                JOIN categories cat ON c.category_id = cat.id 
                LEFT JOIN enrollments e ON c.id = e.course_id";
        
        if (!empty($condition)) {
            $sql .= " WHERE c.$condition";
        }
        $sql .= " GROUP BY c.id, cat.name";
    
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
    
        $stmt = $this->pdo->prepare($sql);
    
        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countAll($condition = '') {
        $sql = "SELECT COUNT(*) AS total FROM courses c";
        if (!empty($condition)) {
            $sql .= " WHERE c.$condition";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function countFiltered($condition, $params) {
        $sql = "SELECT COUNT(*) FROM courses WHERE $condition";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
    
    public function getFiltered($condition, $params, $limit, $offset) {
        $sql = "SELECT c.*, cat.name AS category_name, COUNT(e.student_id) AS enrolled_students 
                FROM courses c 
                JOIN categories cat ON c.category_id = cat.id 
                LEFT JOIN enrollments e ON c.id = e.course_id 
                WHERE $condition 
                GROUP BY c.id, cat.name 
                LIMIT :limit OFFSET :offset";
    
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
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

    public function teacherStatsics($teacher_id){
        $sql = "SELECT COUNT(DISTINCT c.id) AS courses_number,  COUNT(e.student_id) AS enrolled_students, 
        SUM(c.price * (SELECT COUNT(e1.student_id) FROM enrollments e1 WHERE e1.course_id = c.id)) AS total_revenue FROM courses c LEFT JOIN enrollments e ON c.id = e.course_id  WHERE c.teacher_id = :teacher_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['teacher_id' => $teacher_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function TopCourses(){
            $sql = "SELECT c.*, COUNT(e.course_id) AS enrollments_count FROM courses c LEFT JOIN  enrollments e ON  c.id = e.course_id GROUP BY 
               c.id ORDER BY  enrollments_count DESC;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeacherStats() {
        $sql = "SELECT u.username AS teacher_name, COUNT(c.id) AS courses_count, COUNT(e.id) AS total_students FROM 
                users u LEFT JOIN courses c ON u.id = c.teacher_id LEFT JOIN enrollments e ON c.id = e.course_id WHERE u.role = 'teacher'
                GROUP BY u.id ORDER BY total_students DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CoursByCategory() {
        $sql = "SELECT categories.name AS category_name, COUNT(courses.id) AS courses_count FROM categories LEFT JOIN
         courses ON categories.id = courses.category_id GROUP BY categories.id, categories.name ORDER BY courses_count DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AlreadyRolled($student_id,$course_id){
        $sql = "SELECT * FROM enrollments WHERE course_id = :course_id and student_id = :student_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["course_id"=>$course_id, "student_id"=>$student_id]);
        return $stmt->fetchColumn(PDO::FETCH_ASSOC);
    }

    public function Certificat($course_id,$student_id){
        $sql = "SELECT c.*, u.username student_name, e.enrolled_at FROM courses c LEFT JOIN enrollments e ON c.id = e.course_id JOIN users u ON e.student_id = u.id WHERE c.id = :course_id AND u.id = :student_id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["course_id"=>$course_id,"student_id"=>$student_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}