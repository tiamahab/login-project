<?php 
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }

    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");
        //checking connection
    if (!$conn) {
          die("connection failed: " . mysqli_connect_error());
    }
    $match=$_GET['matchId'];
    $sql="SELECT * FROM matches WHERE id ='$match'";
    $result=mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
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
        <header >
            <div class="container">
                <nav>
                    <h3 class="brand">company <span>Name</span></h3>
                    <ul>
                        <li ><a href="#">HOME</a></li>
                        <li ><a href="#">SERVICES</a></li>
                        <li><a href="#">CONTACT</a></li>
                        <li><a href="#">profile</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section>
                <?php 

                while($row=mysqli_fetch_assoc($result)){
                echo"
                    <div class='details'>
                        <p>Match Odds</p>
                        <div class='title'>
                            <div class='team'>Matched</div>
                            <div class='back' style='margin:3px;padding:0px;background:transparent;'>Back</div>
                            <div class='lay' style='margin:3px;padding: 0px;background:transparent;'>Lay</div>
                        </div>
                        <div class='home'>
                            <div class='team'>".$row['home']."</div>
                            <div class='back'>".$row['awayw']."</div>
                            <div class='lay'>".$row['under']."</div>
                        </div>
                        <div class='away'>
                            <div class='team'>".$row['away']."</div>
                            <div class='back'>
                                ".$row['awayw']."
                            </div>
                            <div class='lay'>".$row['under']."</div>
                        </div>
                        <div class='draw'>
                            <div class='team'>Draw</div>
                            <div class='back'>".$row['ov']."</div>
                            <div class='lay'>".$row['under']."</div>
                        </div>
                    </div>
                    ";

                     } 
                     ?>
            </section>
        </main>
        <footer>
            <div class="footer-container">
                <button>
                <a href="logout.php">logout</a>
                </button>
                <br>
                COPYRIGHT &copy 
                    <script> 
                        document.write(new Date().getFullYear());
                    </script>|
                    ALL RIGHTS RESERVED| COMPANY NAME
            </div>
        </footer>
        
        <script src="jquery.1.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="all.js"></script>
    </body>
</html>
