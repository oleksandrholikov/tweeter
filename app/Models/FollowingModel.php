<?php
require_once ('../../config/Connection.php');

class FollowingModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function followinReq($id_user) 
    {
        $follReq = "SELECT user.display_name, user.username FROM follow JOIN user ON follow.id_user_follow = user.id WHERE follow.id_user_followed = :id_user;";

        $follPrepare = $this->dbh->prepare($follReq);

        $follPrepare->bindParam(':id_user', $id_user);
        $follPrepare->execute();
        $result = $follPrepare->fetchAll();

        return $result;
    }
}