<?php
require_once ('../../config/Connection.php');

class ShowPostModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function ShowPostReq($user_id) {
        $showReq = "SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id";//where nana

        $showPrepare = $this->dbh->prepare($showReq);

        // $showPrepare->bindParam(":user_id", $user_id);

        $showPrepare->execute();
        $result = $showPrepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}