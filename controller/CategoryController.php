<?php
require_once "model/CategoryModel.php";

class CategoryController{
    private $CategoryModel;

    public function __construct()
    {
        
        $this->CategoryModel = new CategoryModel();
    }

    public function CreateCategory($categoryname){
        $this->CategoryModel->create($categoryname);
        header("location: index.php?action=manageContent");
    }

    public function DeleteCategory($categoryId){
        $this->CategoryModel->delete($categoryId);
        header("location: index.php?action=manageContent");
    }
    


}
