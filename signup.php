<?php session_start();?>
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
                <h4>SIGNUP FORM</h4>
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
                    <input type="text" name="fullName" placeholder="John Doe">
                </div>
                <div class="input-group">
                    <div class="text">Email</div>
                    <input type="email" name="email" placeholder="email@example.com">
                </div>
                <div class="input-group">
                    <div class="text">Phone</div>
                    <input type="text" name="phone" >
                </div>
                <div class="input-group">
                    <div class="text">Password</div>
                    <input type="password" name="pwd1" >
                </div>                
                <div class="input-group">
                    <div class="text">Confirm</div>
                    <input type="password" name="pwd2" >
                </div>
                <button type="submit" class="field btn"  name="signup">SUBMIT</button>
            </form>
            <p>Already a member? <a href="login.php">Login</a></p>
        </div>

       <script src="jquery.1.min.js"></script>
       <script src="bootstrap.min.js"></script>
       <script src="all.js"></script>
</body>
</html>
