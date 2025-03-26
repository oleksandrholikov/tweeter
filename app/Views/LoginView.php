<?php
include('../Controllers/LoginControllers.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>LoginView</title>
</head>

<body>
    <main class="container-login container">
        <div class="text">
            <h2>We are glad to see you on the AC_octopus!</h2>
            <h3>You can go to your profil here, but if you don't have one, <i class="lien-inscription"><a href="SignUpView.php">click here</a></i></h3>
        </div> 

<div class="login">
  
    <h3 class="login-title">Hello Octopus!</h3>

    <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
        <input type="text" name="user" placeholder="username/email">
        <input type="password" name="password" placeholder="password">
        <button type="submit" class="button" id="button-logIn">Become</button>
    </form>
    <div class="test display-hidden">
        <?php 
        $test = new LoginControllers($dbh);
        $test->dataValidation();
        ?>
    </main>
    <footer></footer>
    <script type="module" src="../../assets/js/main.js"></script>
    <script src="../../assets/js/logIn.js"></script>
</body>

</html>