<?php
require_once ('../../config/Connection.php');

class ExploreModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function usersReq($text)
    {
        session_start();
        $user_id = $_SESSION['userID'];
        $query = "SELECT * FROM user WHERE username LIKE :text AND id <> :id_user;";

        $prepare = $this->dbh->prepare($query);

        $prepare->execute(
            ["text"=> $text . "%",
            "id_user"=> $user_id]
        );
        
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function twetsReq($text)
    {
        $query = "SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id WHERE content LIKE :text ;";

        $prepare = $this->dbh->prepare($query);

        $prepare->execute(
            ["text"=>  $text . "%"]
        );
        
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}