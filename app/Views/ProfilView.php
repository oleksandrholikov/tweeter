<?php
include("./../Controllers/HomeControllers.php");
include("./../Controllers/ProfilController.php");
session_start();
$user = $_SESSION['userID'];
$userInfo = $homeController->userShow($user);
$following = $profilController->showFollowing($user);
$followers = $profilController->showFollowers($user);
$twett = $profilController->showPosts($user);
$postLikes = $profilController->showPostsLike($user);
$postBookMarks = $profilController->showPostsBookMarks($user);
$posrRetweet = $profilController->showPostsRetweet($user);
// print_r($userInfo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>Profil</title>    

</head>

<body>
    <main class="container ProfilPage" data-iduser = "<?php echo $user ?>">
        <section class="sideBar">
            <div class="sideBar-icon"><img src="../../assets/img/icon-octopus.png" alt="icon-octopus"></div>
            <nav class="sideBar-nav navigation-menu">
                <ul class="navigation-list">
                    <li class="navigation-item"> <img src="../../assets/img/icon/home.svg" alt="home-icon"> <a href="#" class="navigation-link" data-page="Home">Home</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/explore.svg" alt="explore-icon"><a href="#" class="navigation-link" data-page="Explore">Explore</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/messages.svg" alt="messages-icon"><a href="#" class="navigation-link" data-page="Messages">Messages</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/profill.svg" alt="profill-icon"><a href="#" class="navigation-link" data-page="Profil">Profil</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/settings.svg" alt="settings-icon"><a href="#" class="navigation-link" data-page="Settings">Settings</a></li>
                </ul>
            </nav>
            
        </section>

        <section class="profil">
            <div class="profil-back" style="background-color:<?php echo $userInfo[0]['header']?>;"></div>

            <div class="block-icon profil-photo"><img src="<?php echo $userInfo[0]['picture']?>" alt="UserPhoto" class="photo photo-profil"></div>
            <div class="profil-info">
                <div class="profil-info-body">
                    <div class="profil-name">
                        <h3 class="profil-display-name"><?php echo $userInfo[0]['display_name'];?></h3>
                        <h4 class="profil-username"><?php echo "@" . $userInfo[0]['username'];?></h4>
                    </div>
                    <h4 class="profil-join-date"><?php echo $userInfo[0]['creation_date'];?></h4>
                    <div class="profil-bio">
                        <p><?php echo $userInfo[0]['biography'];?></p>
                    </div>
                    <div class="profil-follow-group">
                        <h4 class="profil-following link" id="following"><span class="following-nr"><?php echo $following ?></span> Following</h4>
                        <h4 class="profil-followers link" id="followers"><span class="followers-nr"><?php echo $followers ?></span> Followers</h4>
                    </div>
                </div>
                <button class="button profil-btn-edit" id="btn-edit-profil">Edit profil</button>
            </div>
            <div class="profil-posts-container">
                <div class="profil-nav">
                    <ul class="profil-nav-list" id="profil-nav-list">
                        <li class="profil-nav-item link underline" data-item="posts">Posts/ReTweet</li>
                        <li class="profil-nav-item link" data-item="likes">Likes</li>
                        <li class="profil-nav-item link" data-item="bookmarks">BookMarks</li>
                    </ul>
                </div>
                <div class="profil-posts-resalt" id="profil-posts-resalt">
                    <div class="profil-posts-resalt-item user-posts display-action" id="user-posts">
                    <div id="createPost"></div>
                    <div class="showPosts" id="showPosts-posts" data-posts="<?= htmlspecialchars(json_encode($posrRetweet)) ?>">                        
                    </div>
                    </div>
                    <div class="profil-posts-resalt-item user-likes display-hidden" id="user-likes">
                        <div class="showPosts" id="showPosts-likes" data-posts="<?= htmlspecialchars(json_encode($postLikes)) ?>"></div>
                         
                    </div>
                    <div class="profil-posts-resalt-item user-bookmarks display-hidden" id="user-bookmarks">
                        <div class="showPosts" id="showPosts-bookmarks" data-posts="<?= htmlspecialchars(json_encode($postBookMarks)) ?>"></div>
                         
                    </div>

                </div>
            </div>            
        </section>
    </main>
    <footer class="footer" id="footer"></footer>
    <div class="profil-bg background-menu display-hidden" id="background-menu"></div>
    <div class="profil-edit-block display-hidden" id="profil-edit-block">
            <button class="profil-edit-block-exit" id="exit-edit">x</button>
            <form method="POST" action="" class="profil-edit-form" id="profil-edit-form">               
                <div id="edit-firstname">
                    <label for="firstname">Firstame:</label>
                    <input name="firstname" id="firstname" type="text" placeholder="<?php echo $userInfo[0]['firstname'];?>">                   
                </div>
                <div id="edit-lastname">
                    <label for="lastname">Lastname:</label>
                    <input name="lastname" id="lastname" type="text" placeholder="<?php echo $userInfo[0]['lastname'];?>">                   
                </div>                 
                <div id="edit-biography">
                    <label for="biography">Biography:</label>
                    <input type="text" name="biography" id="biography" placeholder="<?php echo $userInfo[0]['biography'];?>">
                </div>                
                <div id="edit-city">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" placeholder="<?php echo $userInfo[0]['city'];?>">
                </div>                
                <div id="edit-country">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" placeholder="<?php echo $userInfo[0]['country'];?>">
                </div>

                <div id="edit-phone">
                    <label for="phone">Phone:</label>
                    <input type="phone" name="phone"  id="phone" placeholder="<?php echo $userInfo[0]['phone'];?>">
                </div>
                <div id="edit-url">
                    <label for="url">Location(url):</label>
                    <input type="text" name="country" id="url" placeholder="<?php echo $userInfo[0]['url'];?>">
                </div>
                <div id="edit-picture">
                    <label for="picture">Picture:</label>
                    <input type="file" name="picture" id="picture">
                </div>
                <div id="edit-header">
                    <label for="header">Header's color:</label>
                    <input type="color" name="header" id="header">
                </div>
                <button type="button" class="button btn-form-edit" id="btn-form-edit">Save</button>            
            </form>        

    </div>
    
    <script type="module" src="../../assets/js/main.js"></script>    
    <script type="module" src="../../assets/js/profilPage.js"></script>
</body>

</html>