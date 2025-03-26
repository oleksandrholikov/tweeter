<?php
class LoginModels
{
    private $dbh;
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function LoginReq($user, $password)
    {
        $query = "SELECT password FROM user WHERE username LIKE :user OR email LIKE :user;";
        $prepare = $this->dbh->prepare($query);

        $prepare->bindParam(':user', $user);

        $prepare->execute();
        $hash = $prepare->fetchColumn();

        if ($hash !== false && password_verify($password, $hash)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function userId($user)
    {
        $userReq = "SELECT id FROM user WHERE username LIKE :user OR email LIKE :user";

        $userPrepare = $this->dbh->prepare($userReq);

        $userPrepare->bindParam(':user', $user);
        $userPrepare->execute();
        $result = $userPrepare->fetchColumn();

        return $result;
    }
}
