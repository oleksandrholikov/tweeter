<?php
class SignUpModel{
    
    private $db;

    public function __construct($dbh){
        $this->db = $dbh;
    }


    public function SignUpReq($firstname, $lastname, $username, $email, $password, $birthdate, $picture, $bio){
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $SignupReq = "INSERT INTO user (firstname, lastname, username, display_name, email, password, birthdate, biography, picture) VALUES (:firstname, :lastname, :username, :display_name, :email, :password, :birthdate, :biography, :picture)";
        
        $SignPrepare = $this->db->prepare($SignupReq);
        $fullName = $firstname . " " . $lastname;
        $SignPrepare->bindParam(':firstname', $firstname);      
        $SignPrepare->bindParam(':lastname', $lastname);
        $SignPrepare->bindParam(':username', $username);       
        $SignPrepare->bindParam(':display_name', $fullName);
        $SignPrepare->bindParam(':email', $email);
        $SignPrepare->bindParam(':birthdate', $birthdate);        
        $SignPrepare->bindParam(':password', $hashed_password);
        $SignPrepare->bindParam(':biography', $bio);
        $SignPrepare->bindParam(':picture', $picture);  
        
        $result = $SignPrepare->execute();
        return $result;

    }
}