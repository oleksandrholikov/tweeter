<?php 
require_once ('../../config/Connection.php');
require_once ('../Models/LoginModels.php');

class LoginControllers 
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new LoginModels($dbh);
    } 
    public function dataValidation() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST['user'];
            $password = $_POST['password'];

            $count = $this->model->LoginReq($user, $password);
            echo $count;
            if($count == 1) {
                session_start();
                $_SESSION['userID'] = $this->model->userId($user);
                
                header("Location:../Views/HomeView.php");
            }
        }
    }
}  