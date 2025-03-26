<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/scss/main.css">
    <link rel="icon" href="../../assets/img/icon-octopus.png">
    <title>SingUp</title>
</head>
<body>
    
    <?php if(isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    
    <main class="container">
        <section class="section singUp">
            <div class="singUp-title">
                <h2>We are glad to see you on the AC_octopus!</h2>
                <span class="h3">You can create you profile here, but if you already have one, <i><a href="LoginView.php">click here</a></i></span>
            </div>
            <div class="singUp-body">
                <h3 class="singUp-body-title">Become an octoupus</h3>
                <form action="" class="singUp-form" id="singUp-form">                
                    <input type="text" name="fullname" placeholder="firstname/lastname" class="input" value ="" id="fullname">
                    <input type="email" name="email" placeholder="email" class="input" id ="email">
                    <input type="password" name="password" placeholder="password" class="input singUp-password" minlength="4" id="password">
                    <input type="password"  placeholder="confirm password" class="input singUp-password" minlength="4" id="confirm-password">
                    <input type="date" name="birthday" class="input singUp-date" id ="birthday">
                    <button type="button" class="button button-singUp" id="button-singUp">Become</button>
                    

                </form>
            </div>
        </section>
       
    </main>    
    <footer class="footer" id="footer"></footer>
    <div class="background-menu display-hidden" id="background-menu"></div>
    <section class=" block block-userName display-hidden" id="block-userName">
                        <h3 class="block-title">Create Your userName</h3>
                        <form action="" class="block-form" method="POST">
                            <input type="text" name="username" id="username" placeholder="@..." class="input">
                            <span class="userName-info">Create Your Own User Name</span>
                            <button type="button" class="button" id="createUserName">Create</button>
                        </form>
    </section>
    <section class="block block-photo display-hidden" id="block-photo">
        <h3 class="block-title">You Can Add Photo</h3>
        <form action="" class="block-form" method="POST">
            <input type="file" name="photo" id="photo-input" placeholder=""class="input input-photo display-hidden" >
            <label for="photo" class="lable-add-photo" id="lable-photo">Add Your Photo</label>
            <button type="button" class="button" id="addPhoto">Add/Next</button>
        </form>
    </section>
    <section class="block block-bio display-hidden" id="block-bio">
        <h3 class="block-title">You Can Write Your Bio</h3>
        <form action="" class="block-form" method="POST">
            <textarea type="text" name="bio-input" id="bio-input" placeholder="Your bio" row=3 class="input bio-input"></textarea>
            <button type="button" class="button" id="addBio">Add/Next</button>
        </form>
    </section>
    <?php 
    include_once('../../app/Controllers/SignUpController.php');
    ?>
    <script src="../../assets/js/singUp.js"></script>
    <script type="module" src="../../assets/js/main.js"></script>
</body>
</html>