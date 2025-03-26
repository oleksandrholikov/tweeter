<?php
require_once ('../../config/Connection.php');
require_once ('../Models/SettingsModels.php');

class SettingsController{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new SettingsModel($dbh);
    }

    public function changePassword($passwords){
        $status = [];
        $user_id = $passwords['user_id'];
        $oldPassword = $passwords['oldPassword'];
        $newPassword = $passwords['newPassword'];
        if($this->model->changePasswordModel($user_id, $oldPassword, $newPassword)){
            $status=[
                'success'=> 'true',
                'text'=> "Password was changed"
            ];
        }else{
            $status=[
                'success'=> 'false',
                'text'=> "Password wasn't changed"
            ];
        }
        echo json_encode($status);
        
    }
    public function changeEmailControler($email){
        $status = [];
        $user_id = $email['user_id'];
        $email = $email['email'];
        
        if($this->model->changeEmailModel($user_id, $email)){
            $status=[
                'success'=> 'true',
                'text'=> "Email was changed"
            ];
        }else{
            $status=[
                'success'=> 'false',
                'text'=> "Email wasn't changed"
            ];
        }

        echo json_encode($status);
}
}
$settings = new SettingsController($dbh);
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $arr = json_decode($data, true);
    
    if(isset($arr['oldPassword']) && isset($arr['newPassword'])){        
        $settings->changePassword($arr);
        // print_r($passwords);
    }
    if(isset($arr['email'])){
        $settings->changeEmailControler($arr);
        
    }
}

