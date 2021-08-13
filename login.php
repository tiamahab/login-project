<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <div class="wrapper">
            <div class="content">
                <h4>LOGIN FORM</h4>
            </div>
            <form method="POST" action="server.php">
                <?php
                    if(isset($_SESSION['error'])){
                        echo "
                        <div class='callout callout-danger text-center'>
                            <p>".$_SESSION['error']."</p> 
                        </div>
                        ";
                        unset($_SESSION['error']);
                    }

                    if(isset($_SESSION['success'])){
                        echo "
                        <div class='callout callout-success text-center'>
                            <p>".$_SESSION['success']."</p> 
                        </div>
                        ";
                        unset($_SESSION['success']);
                    }
                ?>

                <div class="input-group">
                    <div class="text">Full name</div>
                    <input type="email" name="email" placeholder="Enter email..">
                </div>
                <div class="input-group">
                    <div class="text">Password</div>
                    <input type="password" name="pwd" placeholder="Enter password..">
                </div>
                <p><a href="#">Forgot password?</a></p>
                <button type="submit" class="field btn"  name="login">LOGIN</button>
            </form>
            <p>Not yet a member? <a href="signup.php">Signup</a></p>

        </div>

       <script src="jquery.1.min.js"></script>
       <script src="bootstrap.min.js"></script>
       <script src="all.js"></script>
</body>
</html>
