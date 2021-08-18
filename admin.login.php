<?php 
    session_start();
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}

    //login
    if(isset($_POST['login'])){
		$contact = $_POST['phone'];
        $_SESSION['phone']=$contact;
		$password = $_POST['pwd'];
        $sql ="SELECT *, COUNT(*) AS numrows FROM admin_users WHERE contact='$contact'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        if($row['numrows'] > 0){
                if($password==$row['password']){
                    header('location: admin.matches.php');
                }
                else
                {
                    $_SESSION['error'] = 'Incorrect Password';
                    header('location: admin.login.php');
                    
                }
        }
        else
        {
            $_SESSION['error'] = 'Number not found';
            header('location: admin.login.php?Emailnotfound');
            
        }

	}
?>
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
                <h4>Admin Login</h4>
            </div>
            <form method="POST" action="admin.login.php">
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
                    <div class="text">Phone</div>
                    <input type="tel" name="phone" placeholder="Enter 10 digit number..">
                </div>
                <div class="input-group">
                    <div class="text">Password</div>
                    <input type="password" name="pwd" placeholder="Enter password..">
                </div>
                <p><a href="#">Forgot password?</a></p>
                <button type="submit" class="field btn"  name="login">LOGIN</button>
            </form>
            <p>Not admin? <a href="login.php">SWITCH</a></p>

        </div>

       <script src="jquery.1.min.js"></script>
       <script src="bootstrap.min.js"></script>
       <script src="all.js"></script>
</body>
</html>
