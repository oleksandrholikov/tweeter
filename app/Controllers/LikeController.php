<?php 
require_once ('../Models/LikeModel.php');

class LikeController
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new LikeModel($dbh);
    }

    public function dataTake($id_user, $id_tweet) {
        $this->model->LikeReq($id_user, $id_tweet);
    }
}
$likeController = new LikeController($dbh);
$dat = file_get_contents("php://input");
$posts = json_decode($dat, true);
if (isset($posts['id_user']) && isset($posts['id_post'])) {
    $stat = $likeController->dataTake($posts['id_user'], $posts['id_post']);
    return $stat    ;
} else {
    echo "error";
}