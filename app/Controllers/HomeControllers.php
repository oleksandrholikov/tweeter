<?php
require_once('../../config/Connection.php');
require_once('../Models/HomeModels.php');

class HomeControllers
{
    private $model;

    public function __construct($dbh)
    {
        $this->model = new HomeModels($dbh);
    }

    public function userShow($id_user) {
        $user = $this->model->user($id_user);
        return $user;
    }

    public function upLoadImag(){
        header("Content-Type: application/json");
        $uploadDir = "../../assets/img/postImages/";
         if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        };
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
             $file = $_FILES["file"];

        if ($file["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "error" => "Ошибка загрузки"]);
        exit;
        };   
        $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);    
        $uniqueFileName = uniqid("img_", true) . "." . $fileExt;
        $targetFilePath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            echo json_encode(["success" => true, "image_url" => $targetFilePath]);
        } else {
            echo json_encode(["success" => false, "error" => "Error saving file"]);
        }
        } else{
            echo json_encode(["success" => false, "error" => "File not uploaded"]);
        }
    }

}
$homeController = new HomeControllers($dbh);
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])){
    $homeController -> upLoadImag();
}

