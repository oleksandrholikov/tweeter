<?php
require_once ('../../config/Connection.php');
require_once ('../Models/CreatePostModels.php');

class CreatePostController{
    private $createPost;

    public function __construct($dbh){
        $this->createPost = new CreatePostModel($dbh);
    }
    public function createPostConst($post){
        $this->createPost->createPost($post);
    }
}

$createPost = new CreatePostController($dbh);
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $post = json_decode($data, true);
    $createPost-> createPostConst($post);
}