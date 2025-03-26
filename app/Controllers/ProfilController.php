<?php
require_once ('../Models/ProfilModel.php');

class ProfilController 
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new ProfiModel($dbh);
    }

    public function showFollowing($id_user) 
    {
        $following = $this->model->followingReq($id_user);
        return $following;
    }

    public function showFollowers($id_user) 
    {
        $followers = $this->model->followersReq($id_user);
        return $followers;
    }
    public function showPosts($id_user) 
    {
        $posts = $this->model->showPostsRqt($id_user);
        return $posts;
    }
    public function showPostsLike($id_user){
        $posts = $this->model->showPostsLikeModel($id_user);
        return $posts;
    }
    public function showPostsBookMarks($id_user){
        $posts = $this->model->showPostsBookMarksModel($id_user);
        return $posts;
    }
    public function upDateProfilController($data){
        $status =[
            'success'            
        ];
        if($this->model->upDateUserModel($data)){
            $status['success'] = true;
        }else{
            $status['success'] = false;
        }
        echo json_encode($status);
    }

    public function showPostsRetweet($id_user){
        $posts = $this->model->showPostsRetweetModel($id_user);
        return $posts;
    }
}




$profilController = new ProfilController($dbh);
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $arr = json_decode($data, true);
    if($arr['edit']=='true'){
        $profilController->upDateProfilController($arr);
    }
    
}
