<?php
require_once ('../Models/FollowingModel.php');

class FollowingController 
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new FollowingModel($dbh);
    }

    public function showFollowing($id_user)
    {
        $following = $this->model->followinReq($id_user);
        return $following;
    }
}
$followingController = new FollowingController($dbh);