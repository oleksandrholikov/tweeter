<?php
class SettingsModel{
    private $db;

    public function __construct($dbh){
        $this->db = $dbh;
    }
    public function upDatePasswordModel($user_id, $newPassword){
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password=:password WHERE id=:user_id";
        $stmt=$this->db->prepare($sql);
        return $stmt->execute([
            'password'=>$hashed_password,
            'user_id'=>$user_id
        ]);
    }
    public function changePasswordModel($user_id, $oldPassword, $newPassword){
        $sql = "SELECT password FROM user WHERE id =:user_id";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([
            'user_id'=> $user_id
        ]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        // print_r( $res);
        if(password_verify($oldPassword, $res['password'])){
            if($this->upDatePasswordModel($user_id, $newPassword)){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
        
    }

    public function changeEmailModel($user_id, $email){
        $sql = "UPDATE user SET email=:email WHERE id=:user_id";
        $stmt=$this->db->prepare($sql);
        return $stmt->execute([
            'email'=> $email,
            'user_id'=> $user_id
        ]);
    }
}