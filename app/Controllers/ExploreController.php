<?php
require_once ('../Models/ExploreModel.php');
require_once ('../Models/SubscriptionModel.php');
class ExploreController
{
    private $model;
    private $subscription;

    public function __construct($dbh)
    {
        $this->model = new ExploreModel($dbh);
        $this->subscription = new SubscriptionModel($dbh);
    }

    public function showUsers($text) {
        $result = $this->model->usersReq($text);
        session_start();
        $id_user = $_SESSION['userID'];
        foreach ($result as $value) {
            $buttonText = $this->subscription->isSubscribed($id_user, $value['id']);
            echo"<div id='".$value['id']."' class='profilInfo'>
                <div class='profilInfo-photo block-icon'>
                    <img src=" . $value['picture'] . " alt='UserPhoto' class='photo'>
                </div>
                <div class='profilInfo-Info'>
                    <span class='profilInfo-Info-name'>" . $value['display_name'] . "</span>
                    <span class='profilInfo-Info-userName color-light'>" . $value['username'] . "</span>
                </div>
                <button id='subscribe' class='button'>$buttonText</button>
            </div>";
        }
    }

    public function showTwets($text) {
        $result = $this->model->twetsReq($text);
        foreach ($result as $value) {
            echo '<div class="post" date-id_post="'.$value['id'].'">
                        <div class="post-userInfo" date-id_owner="'.$value['creation_date'].'">
                            <div class="post-userInfo-pic"><img src="../../assets/img/icon-octopus.png" alt="owner photos"></div>
                            <div class="post-userInfo-info">
                                <span class="post-userInfo-display-name" id="post-userInfo-display-name">'.$value["display_name"].'</span>
                                <span class="post-userInfo-username" id="post-userInfo-username">'.$value["username"].'</span>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="post-content-text" id="post-content-text">
                                <p>'.$value["content"].'</p>
                            </div>
                            <div class="post-content-pics" id="post-content-pics" data-arrPhotos="${arrMedia}"><div class="post-content-btn btn-prev" id="post-btn-prev"><img src="../../assets/img/icon/icon-arrow-prev.png" alt="arrow previous"></div><img src="'.$value['media1'].'" alt="img from post"  data-post_id=${item.id} id="content-post-img"><div class="post-content-btn btn-next" id="post-btn-next"><img src="../../assets/img/icon/icon-arrow-next.png" alt="arrow next"></div>

                        </div>
                        <div class="post-interactiv">
                            <ul class="post-interactiv-list">
                                <li class="post-interactiv-item"><img src="../../assets/img/icon/icon-comment.svg" alt="icon comments"><span class="post-interactiv-comments" >17</span></li>
                                <li class="post-interactiv-item"><img src="../../assets/img/icon/icon-repost.svg" alt="icon repost"><span class="post-interactiv-reposts" >13</span></li>
                                <li class="post-interactiv-item"><img src="../../assets/img/icon/icon-like.svg" alt="icon like"><span class="post-interactiv-likes">78</span></li>
                                <li class="post-interactiv-item"><img src="../../assets/img/icon/icon-bookmark.svg" alt="icon bookmark"><span class="post-interactiv-bookmarks"></span></li>
                            </ul>
                        </div>
                    </div>';
        }
    }
}

$exploreControler = new ExploreController($dbh);
$data = file_get_contents("php://input");
$post = json_decode($data, true);
if($post['info'][0] == "@") {
    $exploreControler-> showUsers(substr($post['info'], 1));
} elseif($post['info'][0] == "#") {
    $exploreControler-> showTwets($post['info']);
}