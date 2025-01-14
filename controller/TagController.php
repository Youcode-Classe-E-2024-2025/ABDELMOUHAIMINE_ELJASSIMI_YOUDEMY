<?php
require_once "model/TagModel.php";

class TagController{
    private $tagModel;

    public function __construct()
    {
        
        $this->tagModel = new TagModel();
    }

    public function CreateTag($tagName){
        $this->tagModel->create($tagName);
        header("location: index.php?action=manageContent");
    }

    public function DeleteTag($tagId){
        $this->tagModel->delete($tagId);
        header("location: index.php?action=manageContent");
    }

    public function BulkTag($tags,$course){
        $this->tagModel->InsertBulkTag($tags,$course);
        header("location: index.php?action=manageContent");
    }
    


}
