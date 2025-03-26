<?php
require_once ('../../config/Connection.php');

class LikeModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    
    public function inLike($id_user, $id_tweet) 
    {
        $query = "SELECT COUNT(*) FROM likes WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();

        return $prepare->fetchColumn() > 0 ? "none" : "red";
    }

    public function LikeReq($id_user, $id_tweet)
    {
        $status = $this->inLike($id_user, $id_tweet);

        if ($status === "red") {
            $this->addLike($id_user, $id_tweet);
            echo "red";
        } else {
            $this->delletLike($id_user, $id_tweet);
            echo "none";
        }
    }

    public function addLike($id_user, $id_tweet) {
        $query = "INSERT INTO likes (id_user, id_tweet) VALUES (:id_user, :id_tweet);";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }

    public function delletLike($id_user, $id_tweet) {
        $query = "DELETE FROM likes WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }
}