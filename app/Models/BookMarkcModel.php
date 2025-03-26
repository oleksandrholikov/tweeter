<?php
require_once ('../../config/Connection.php');

class BookMarkcModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function inBookMarks($id_user, $id_tweet) 
    {
        $query = "SELECT COUNT(*) FROM bookmark WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();

        return $prepare->fetchColumn() > 0 ? "red" : "green";
    }

    public function bookMarksReq($id_user, $id_tweet)
    {
        $status = $this->inBookMarks($id_user, $id_tweet);

        if ($status === "green") {
            $this->addBookMarks($id_user, $id_tweet);
            echo "green";
        } else {
            $this->delletBookMarks($id_user, $id_tweet);
            echo "red";
        }
    }

    public function addBookMarks($id_user, $id_tweet) {
        $query = "INSERT INTO bookmark (id_user, id_tweet) VALUES (:id_user, :id_tweet);";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }

    public function delletBookMarks($id_user, $id_tweet) {
        $query = "DELETE FROM bookmark WHERE id_user = :id_user AND id_tweet = :id_tweet";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user", $id_user);
        $prepare->bindParam(":id_tweet", $id_tweet);
        $prepare->execute();
    }
}