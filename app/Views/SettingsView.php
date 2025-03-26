<?php
include("./../Controllers/LoginControllers.php");
include("./../Controllers/HomeControllers.php");
session_start();
$user_id = $_SESSION['userID'];
//  echo "Hello" . $user_id;
$userInfo = $homeController->userShow($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>Settings</title>
</head>
<body>
<main class="container settingsPage" data-idUser = "<?php echo $user ?>"> 
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
                    <span class="profilInfo-Info-name"><?php echo $userInfo[0]['display_name'];?></span>
                    <span class="profilInfo-Info-userName color-light"><?php echo "@" . $userInfo[0]['username'];?></span>
                </div>
            </div>
    </section>

    <section class="settings">
            <div class="settings-item settings-theme">
                <form action="" class="settings-theme-form">
                <label for="settings-theme-select">Choose theme </label>
                    <select name="settings-theme-select" id="settings-theme-select" class="input">
                        <option value="classic">Classic</option>
                        <option value="white">Black-White</option>
                        <option value="blue">Blue</option>
                    </select> 
                    <button type="button" id="select-theme-btn" class="button select-theme-btn">Change Theme</button>
                </form>
            </div>
            <div class="settings-item settings-password" data-userid ="<?php echo $user_id ?>" id="settings-password">
                <form action="" class="settings-password-form">
                    <label for="settings-password-input"> Change Password</label>
                    <input type="password" name="settings-password-old" placeholder="Old Password" id="settings-password-old">
                    <input type="password" name="settings-password-input" placeholder="New Password" id="settings-password-input">
                    <input type="password" name="settings-password-confirm" placeholder="Confirm New Password" id="settings-password-confirm">
                    <button type="button" class="button settings-password-btn" id="settings-password-btn">Change Password</button>
                </form>
            </div>
            <div class="settings-item settings-email" id="settings-email" data-userid ="<?php echo $user_id ?>">
                <form action="" class="settings-email-form">
                    <label for="settings-email-input"> Change Email</label>
                    <input type="email" name="settings-email-input" placeholder="New Email" id="settings-email-input">
                    <button type="button" class="button settings-email-btn" id="settings-email-btn">Change Email</button>
                </form>
            </div>
            <div class="settings-item settings-logOut">
                <button type="button" class="button settings-logOut-btn" id="settings-logOut-btn">LOG OUT</button>
            </div>
    </section>
    </main>
    <footer></footer>
    <script src="../../assets/js/settings.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
</body>
</html>