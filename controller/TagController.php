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
    


}
