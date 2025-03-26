<?php
include("./../Controllers/HomeControllers.php");
include("./../Controllers/FollowersConroller.php");
session_start();
$user = $_SESSION['userID'];
$userInfo = $homeController->userShow($user);
$followersARR = $followersController->showFollower($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>Follower</title>
</head>

<body>
    <main class="container homePage">
        <section class="sideBar">
            <div class="sideBar-icon"><img src="../../assets/img/icon-octopus.png" alt="icon-octopus"></div>
            <nav class="sideBar-nav navigation-menu">
                <ul class="navigation-list">
                    <li class="navigation-item"> <img src="../../assets/img/icon/home.svg" alt="home-icon"> <a href="#" class="navigation-link">Home</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/explore.svg" alt="explore-icon"><a href="#" class="navigation-link">Explore</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/messages.svg" alt="messages-icon"><a href="#" class="navigation-link">Messages</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/profill.svg" alt="profill-icon"><a href="#" class="navigation-link">Profil</a></li>
                    <li class="navigation-item"><img src="../../assets/img/icon/settings.svg" alt="settings-icon"><a href="#" class="navigation-link">Settings</a></li>
                </ul>
            </nav>
            <div class="sideBar-profilInfo">
                <div class="profilInfo-photo block-icon"><img src="<?php echo $userInfo[0]['picture'];?>" alt="UserPhoto" class="photo"></div>
                <div class="profilInfo-Info">
                    <span class="profilInfo-Info-name"><?php echo $userInfo[0]['display_name']; ?></span>
                    <span class="profilInfo-Info-userName color-light"><?php echo "@" . $userInfo[0]['username']; ?></span>
                </div>
            </div>
        </section>
        <section class="folow">
            <a href="./ProfilView.php" class="button">Prev</a>
            <h3 class="display-name">My follow</h3>            
            <div class="folow-group">
                <?php
                foreach ($followersARR as $value) {
                    echo "<div class='folow-item'><h4>" . $value["display_name"] . " <span>" . "@" . $value["username"] . "</span> </h4></div>";
                }
                ?>
            </div>
        </section>
    </main>
    <footer class="footer" id="footer"></footer>
    <script type="module" src="../../assets/js/main.js"></script>
    <script src="../../assets/js/homePage.js"></script>
</body>

</html>