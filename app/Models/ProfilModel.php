<?php
require_once ('../../config/Connection.php');

class ProfiModel
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function followingReq($id_user) {
        $follReq = "SELECT COUNT(*) FROM follow WHERE id_user_follow = :id_user";

        $follPrepare = $this->dbh->prepare($follReq);

        $follPrepare->bindParam(':id_user', $id_user);
        $follPrepare->execute();
        $result = $follPrepare->fetchColumn();

        return $result;
    } 

    public function followersReq($id_user) {
        $follReq = "SELECT COUNT(*) FROM follow WHERE id_user_followed = :id_user";

        $follPrepare = $this->dbh->prepare($follReq);

        $follPrepare->bindParam(':id_user', $id_user);
        $follPrepare->execute();
        $result = $follPrepare->fetchColumn();

        return $result;
    }   
    public function changeDisplayName($id){
    $sql = "SELECT CONCAT(firstname, ' ',lastname) AS 'name' FROM user WHERE id = :id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
        'id' => $id
    ]);
    $name = $stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($name);
    $sql_d="UPDATE user SET display_name = :name WHERE id = :id";
    $stmt_d = $this->dbh->prepare($sql_d);
    $stmt_d->execute([
        'name' => $name['name'],
        'id' => $id
    ]);   

    }

    public function showPostsRqt($id_user){
        $sql="SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id WHERE user.id = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'id_user' => $id_user
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function showPostsLikeModel($id_user){
        $sql = "SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id JOIN likes ON tweet.id = likes.id_tweet WHERE likes.id_user = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'id_user' => $id_user
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function showPostsBookMarksModel($id_user){
        $sql = "SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id JOIN bookmark ON tweet.id = bookmark.id_tweet WHERE bookmark.id_user = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'id_user' => $id_user
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function showPostsRetweetModel($id_user){
        $sql = "SELECT tweet.*, user.display_name, user.username, user.picture FROM tweet JOIN user ON tweet.id_user = user.id JOIN retweet ON tweet.id = retweet.id_tweet WHERE retweet.id_user = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'id_user' => $id_user
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function upDateUserModel($data){
        $sql = "UPDATE user SET ";
        $updates = []; // Array to store updates
        $params = []; // Array to store parameters
    
        if($data['firstname'] != 'null'){
            $updates[] = "firstname = :firstname";
            $params[':firstname'] = $data['firstname'];
        }
        if($data['lastname'] != 'null'){
            $updates[] = "lastname = :lastname";
            $params[':lastname'] = $data['lastname'];
        }
        if($data['phone'] != 'null'){
            $updates[] = "phone = :phone";
            $params[':phone'] = $data['phone'];
        }
        if($data['city'] != 'null'){
            $updates[] = "city = :city";
            $params[':city'] = $data['city'];
        }
        if($data['country'] != 'null'){
            $updates[] = "country = :country";
            $params[':country'] = $data['country'];
        }
        if($data['biography'] != 'null'){
            $updates[] = "biography = :biography";
            $params[':biography'] = $data['biography'];
        }
        if($data['header'] != 'null'){
            $updates[] = "header = :header";
            $params[':header'] = $data['header'];
        }
        if($data['picture'] != 'null'){
            $updates[] = "picture = :picture";
            $params[':picture'] = $data['picture'];
        }
        if($data['url'] != 'null'){
            $updates[] = "url = :url";
            $params[':url'] = $data['url'];
        }
    
        if (count($updates) > 0) {
            $sql .= implode(", ", $updates);
            $sql .= " WHERE id = :id_user";
            $params[':id_user'] = intval($data['id_user']);
    
            $stmt = $this->dbh->prepare($sql);
            $res =  $stmt->execute($params);
            if($res){
                $this->changeDisplayName(intval($data['id_user']));
                return true;
            }else{
                return false;
            }
        }
    }

}
