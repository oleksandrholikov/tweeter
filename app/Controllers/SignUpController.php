<?php
require_once ('../../config/Connection.php');
require_once ('../Models/SignUpModel.php');
// session_start();
// print_r($_POST);
// class SignUpController{
//     public $model;
class SignUpController{
    private $model;

    public function __construct($dbh){
        $this->model = new SignUpModel($dbh);
    }

    public function SignUp($arr){
          
            $fullname = trim($arr['fullname']);
            $nameParts = explode(" ", $fullname, 2);
            $firstname = isset($nameParts[0]) ? $nameParts[0]: NULL;
            $lastname = isset($nameParts[1]) ? $nameParts[1]: NULL;
            $username = $arr['username'];
            $email = $arr['email'];
            $password = $arr['password'];
            $birthdate = $arr['birthday'];
            $picture = isset($arr['picture'])? $arr['picture']: "../../assets/img/icon-octopus.png";
            $bio = isset($arr['bio'])? $arr['bio']: "Null"; 
        

        if(empty($firstname) || empty($lastname)){
            $error = "Please enter your first and last name";
        }
        elseif(empty($email)){
            $error = "Please enter your email";
        }
        elseif(empty($birthdate) || $this->isValideDate($birthdate)){
            $error = "Please enter a valid date of birth";
        }
        else{
            $result = $this->model->SignUpReq($firstname, $lastname, $username, $email, $password, $birthdate, $picture, $bio);
            if($result) {
                $_SESSION['success'] = "user created successfully";
                header("Location: ../Views/LoginView.php");
                exit();
            }
            else{
                $error = "There was an error registering the user";
            }
        }
        if(isset($error)){
            $_SESSION['error'] = $error;
        }
        header("Location: ../Views/SignUpView.php");
        exit();
    
    }
    
    
    public function isValideDate($date){
        $date = DateTime::createFromFormat('d-m-Y', $date);
        return $date && $date->format('d-m-Y') === $date;
    }
    
    public function logout(){
        session_destroy();
        header("Location: ../Views/SignUpView.php"); 
        exit(); 
    }

    public function upLoadProfillPicsController(){
        header("Content-Type: application/json");
        $uploadDir = "../../assets/img/profilImages/";
         if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        };
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
             $file = $_FILES["file"];

        if ($file["error"] !== UPLOAD_ERR_OK) {
        // echo json_encode(["success" => false, "error" => "Error uploding file"]);
        exit;
        };   
        $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);    
        $uniqueFileName = uniqid("img_", true) . "." . $fileExt;
        $targetFilePath = $uploadDir . $uniqueFileName;
        $status = [
            'success' => 'true',
            'image_url' => $targetFilePath,
            'error' => ""
        ];
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            $status['image_url'] = $targetFilePath;
            // echo json_encode(["success" => true, "image_url" => $targetFilePath]);
        } else {
            $status['success'] = 'false';
            $status['error'] = 'Error saving file';
            // echo json_encode(["success" => false, "error" => "Error saving file"]);
        }
        } else{
            $status['success'] = 'false';
            $status['error'] = 'File not uploaded';
            
        }
        echo json_encode($status);
    }
}

$Signup = new SignUpController($dbh);
// $Signup->SignUp();
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])){
    $Signup->upLoadProfillPicsController();
}
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $arr = json_decode($data, true);
    if($arr['post']=='true'){
        $Signup->SignUp($arr);
    }
    
}