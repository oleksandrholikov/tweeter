<?php
require_once ('../../config/Connection.php');

class ReTWeetModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    
    public function ReTweet($id_user, $id_tweet) 
    {
        $query = "SELECT COUNT(*) FROM retweet WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();

        return $prepare->fetchColumn() > 0 ? "none" : "red";
    }

    public function ReTweetReq($id_user, $id_tweet)
    {
        $status = $this->ReTweet($id_user, $id_tweet);

        if ($status === "red") {
            $this->addReTweet($id_user, $id_tweet);
            echo "red";
        } else {
            $this->delletReTweet($id_user, $id_tweet);
            echo "none";
        }
    }

    public function addReTWeet($id_user, $id_tweet) {
        $query = "INSERT INTO retweet (id_user, id_tweet) VALUES (:id_user, :id_tweet);";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }

    public function delletReTweet($id_user, $id_tweet) {
        $query = "DELETE FROM retweet WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }
}