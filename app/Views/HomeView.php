<?php
include("./../Controllers/LoginControllers.php");
include("./../Controllers/HomeControllers.php");
include("./../Controllers/ShowPostController.php");
session_start();
$user = $_SESSION['userID'];
// echo "Hello" . $user;
$userInfo = $homeController->userShow($user);
$json = json_encode($userInfo);
echo "<script>localStorage.setItem('userInfo', '" . $json . "');</script>";
$twett = $PostController->showPost($user);
// print_r($twett);

// print_r($userInfo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>Home</title>
</head>
<body>
    <main class="container homePage" data-idUser = "<?php echo $user ?>">
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
            <div class="sideBar-profilInfo">
                <div class="profilInfo-photo block-icon"><img src="<?php echo $userInfo[0]['picture'];?>" alt="UserPhoto" class="photo"></div>
                <div class="profilInfo-Info">
                    <span id="<?php echo $userInfo[0]['id'] ?>" class="profilInfo-Info-name"><?php echo $userInfo[0]['display_name'];?></span>
                    <span class="profilInfo-Info-userName color-light"><?php echo "@" . $userInfo[0]['username'];?></span>
                </div>
            </div>
        </section>
        <section class="bodyHome">            
            <div class="homePage-createPost bodyHome-item">
                <div class="createPost-container-img block-icon"><img src="<?php echo $userInfo[0]['picture'];?>" alt="photo from user profil" class="createPost-img"></div>
                <div class="createPost-module" id="createPost">              
                    
                </div>
            </div>
            <div class="showPosts bodyHome-item" id="showPosts" data-posts="<?= htmlspecialchars(json_encode($twett)) ?>">
                
            </div>
        </section>
    </main>
    <footer class="footer" id="footer"></footer>
    <script type="module" src="../../assets/js/main.js"></script>
    <script src="../../assets/js/homePage.js"></script>
    <script src="../../assets/js/bookMarks.js" defer></script>   
    <script src="../../assets/js/like.js" defer></script>
    <script src="../../assets/js/retweet.js" defer></script>
          
</body>
</html>