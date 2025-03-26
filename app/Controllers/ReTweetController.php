<?php
require_once ('../Models/ReTweetModel.php');

class ReTweetController
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new ReTweetModel($dbh);
    }

    public function dataTake($id_user, $id_tweet) {
        $this->model->ReTweetReq($id_user, $id_tweet);
    }
}
$reTweetController = new ReTweetController($dbh);
$dat = file_get_contents("php://input");
$posts = json_decode($dat, true);
if (isset($posts['id_user']) && isset($posts['id_post'])) {
    $stat = $reTweetController->dataTake($posts['id_user'], $posts['id_post']);
    return $stat    ;
} else {
    echo "error";
}