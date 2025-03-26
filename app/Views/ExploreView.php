<?php
include("./../Controllers/LoginControllers.php");
include("./../Controllers/HomeControllers.php");
session_start();
$user = $_SESSION['userID'];
$userInfo = $homeController->userShow($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>Explore</title>
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
        <section class="searchResult">
            <h3>SEARCHING USERS</h3>
            <input type="text" id="search" class="input">
            <div class="searchResult-container">
            <div id="result" class="searchResult-result">                
            </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script type="module" src="../../assets/js/main.js"></script>
    <script src="../../assets/js/explorePage.js"></script>
</body>
</html>