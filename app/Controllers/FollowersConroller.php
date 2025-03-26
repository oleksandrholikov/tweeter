<?php
require_once ('../Models/FollowersModel.php');

class FollowersController 
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new FollowersModel($dbh);
    }

    public function showFollower($id_user)
    {
        $followers = $this->model->followersReq($id_user);
        return $followers;
    }
}
$followersController = new FollowersController($dbh);