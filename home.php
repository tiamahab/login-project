<?php 
    session_start();
    if(!isset($_SESSION['email'])){
        header('location: logout.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body style="background:black">
        <header >
            <img src="https://images.app.goo.gl/oP6niPCxRkZkAazbA" alt="" style="width:100%; position:absolute; z-index:-10;">
            <div class="container">
                <nav>
                    <h3 class="brand">logo</h3>
                    <ul>
                        <li ><a href="#">HOME</a></li>
                        <li ><a href="#">SERVICES</a></li>
                        <li><a href="#">CONTACT</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <main>
            <button style="width:50%; background-color:crimson; border:none; color:white;">
            <a style="color:white;" href="logout.php">logout</a>
            </button>
            

        </main>

        <footer>
            <div class="footer-container">

            </div>
        </footer>
    </body>
</html>
