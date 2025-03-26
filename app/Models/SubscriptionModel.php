<?php
require_once ('../../config/Connection.php');

class SubscriptionModel 
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function isSubscribed($id_user_follow, $id_user_followed)
    {
        $query = "SELECT COUNT(*) FROM follow WHERE id_user_follow = :id_user_follow AND id_user_followed = :id_user_followed";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user_follow", $id_user_follow);
        $prepare->bindParam(":id_user_followed", $id_user_followed);
        $prepare->execute();

        return $prepare->fetchColumn() > 0 ? "Unsubscribe" : "Subscribe";
    }

    public function followReq($id_user_follow, $id_user_followed)
    {
        $status = $this->isSubscribed($id_user_follow, $id_user_followed);

        if ($status === "Subscribe") {
            $this->follow($id_user_follow, $id_user_followed);
            echo "subscribed";
        } else {
            $this->unfollow($id_user_follow, $id_user_followed);
            echo "unsubscribed";
        }
    }

    public function follow($id_user_follow, $id_user_followed) 
    {
        $query = "INSERT INTO follow (id_user_follow, id_user_followed) VALUES (:id_user_follow, :id_user_followed);";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user_follow", $id_user_follow);
        $prepare->bindParam(":id_user_followed", $id_user_followed);
        $prepare->execute();
    }

    public function unfollow($id_user_follow, $id_user_followed) 
    {
        $query = "DELETE FROM follow WHERE id_user_follow = :id_user_follow AND id_user_followed = :id_user_followed";
        $prepare = $this->dbh->prepare($query);
        $prepare->bindParam(":id_user_follow", $id_user_follow);
        $prepare->bindParam(":id_user_followed", $id_user_followed);
        $prepare->execute();
    }
}
