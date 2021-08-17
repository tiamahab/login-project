<?php 
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }

    //connect to the database
$conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");
if(!$conn){
die("connection failed:" . mysqli_connect_error());
}

    $match=$_GET['matchId'];
    $_SESSION['matchId']=$match;
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
            <nav class="navbar navbar-expand-sm " id="my-navbar">
                <a id="navbar-brand" href="home1.php">CO. NAME</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                  <span ><i class="fas fa-align-justify"></i></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav m-auto">
                        <li>
                            <a href="home1.php"><i class="fas fa-home"></i> HOME</a>
                        </li>

                        <li >
                            <a href="#"><i class="fas fa-phone"></i> CONTACT US</a>
                        </li>

                        <li>
                            <a href="#"><i class="fas fa-chevron-down"></i> SERVICES</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#"><i class="fas fa-user"></i> ABOUT US</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <section>
                <?php 

                while($row=mysqli_fetch_assoc($result)){
                echo"
                    <div class='details'>
                        <div id='banner'>
                            <div class='odd'><a href='match_details.php?matchId=".$_SESSION['matchId']."'>Match odds</a></div>
                            <div class='over''><a class='active' href='over_under.php?matchId=".$_SESSION['matchId']."'>Over / Under</a></div>
                        </div>
                        <div class='title'>
                            <div class='team'>Matched</div>
                            <div class='back' style='margin:3px;padding:0px;background:transparent;'>Back</div>
                            <div class='lay' style='margin:3px;padding: 0px;background:transparent;'>Lay</div>
                        </div>
                        <div class='home'>
                            <div class='team'>OVER</div>
                            <div class='back'><a href='over_under_back.php?kind=over&matchid=".$row['id']."'>".$row['under']."</a></div>
                            <div class='lay'><a href='over_under_lay.php?kind=over&matchid=".$row['id']."'>".$row['ov']."</a></div>
                        </div>
                        <div class='away'>
                            <div class='team'>UNDER</div>
                            <div class='back'><a href='over_under_back.php?kind=under&matchid=".$row['id']."'>".$row['ov']."</a></div>
                            <div class='lay'><a href='over_under_lay.php?kind=under&matchid=".$row['id']."'>".$row['under']."</a></div>
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
