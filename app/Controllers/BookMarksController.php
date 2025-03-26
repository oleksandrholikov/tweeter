<?php 
require_once ('../Models/BookMarkcModel.php');

class BookMarksController
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new BookMarkcModel($dbh);
    }

    public function dataTake($id_user, $id_tweet) {
        $this->model->bookMarksReq($id_user, $id_tweet);
    }
}
$bookMarksController = new BookMarksController($dbh);
$data = file_get_contents("php://input");
$post = json_decode($data, true);
if (isset($post['id_user']) && isset($post['id_post'])) {
    $status = $bookMarksController->dataTake($post['id_user'], $post['id_post']);
    return $status;
} else {
    echo "error";
}
