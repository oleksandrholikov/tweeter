<?php
require_once ('../Models/ShowPostModel.php');

class ShowPostController
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new ShowPostModel($dbh);
    }

    public function showPost($user_id)
    {
        $twitt = $this->model->ShowPostReq($user_id);
        return $twitt;
    }
}
$PostController = new ShowPostController($dbh);
