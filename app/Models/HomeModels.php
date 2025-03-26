<?php

class HomeModels
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function user($id_user)
    {
        $userReq = "SELECT * FROM user WHERE id = :id_user";

        $userPrepare = $this->dbh->prepare($userReq);

        $userPrepare->bindParam(':id_user', $id_user);

        $userPrepare->execute();
        $result = $userPrepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } 

    public function tweet() 
    {

    }
}