<?php

require_once "config.php";

class CourseModel{
    protected $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createCourse($title,$Description,$category,$tags,$teacher_id,$videoPath,$documentPath){
        $sql = "INSERT INTO courses (title,description,category_id,teacher_id,video_path,document_path) values (:title,:description,:category_id,:teacher_id,:video_path,:document_path)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["title"=>$title,"description"=>$Description,"category_id"=>$category,"teacher_id"=>$teacher_id,"video_path"=>$videoPath,"document_path"=>$documentPath]);

        $course_id = $this->pdo->lastInsertId();
        $sql = "INSERT INTO course_tags (course_id,tag_id) values (:course_id,:tag_id)";
        $stmt =$this->pdo->prepare($sql);
        foreach ($tags as $tag){
            $stmt->execute(['course_id'=>$course_id,'tag_id'=>$tag]);
        }

    }

    public function getAll(){
        $sql = "SELECT * FROM courses";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}