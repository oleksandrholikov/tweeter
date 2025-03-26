<?php
require_once ('../Models/SubscriptionModel.php');

class SubscriptionController
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new SubscriptionModel($dbh);
    } 

    public function dataTake($id_user_follow, $id_user_followed)
    {
        $this->model->followReq($id_user_follow, $id_user_followed);
    }
}
$subscriptionController = new SubscriptionController($dbh);
$data = file_get_contents("php://input");
$post = json_decode($data, true);
if (isset($post['id_user']) && isset($post['id_user_followed'])) {
    $status = $subscriptionController->dataTake($post['id_user'], $post['id_user_followed']);
    return $status;
} else {
    echo "error";
}