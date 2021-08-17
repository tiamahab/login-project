<?php 
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }

    //connect to the database
    $conn = mysqli_connect("localhost","root", "","brian");
    //checking connection
    if (!$conn) {
          die("connection failed: " . mysqli_connect_error());
        }

    $kind=$_GET['kind'];
    $id=$_GET['matchid'];
    $_SESSION['matchId']=$id;
    $sqluser="SELECT * FROM users WHERE contact ='".$_SESSION['phone']."'";
    $res=mysqli_query($conn, $sqluser);
    $rowuser=mysqli_fetch_assoc($res);
    $userid=$rowuser['id'];

    $sql="SELECT * FROM matches WHERE id ='".$_SESSION['matchId']."'";
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
                            <div class='odd'><a class='active' href='match_details.php?matchId=".$_SESSION['matchId']."'>Match odds</a></div>
                            <div class='over'><a  href='over_under.php?matchId=".$_SESSION['matchId']."'>Over / Under</a></div>
                        </div>
                        <div class='title'>
                            <div class='team'>Matched</div>
                            <div class='back' style='margin:3px;padding:0px;background:transparent;'>Back</div>
                            <div class='lay' style='margin:3px;padding: 0px;background:transparent;'>Lay</div>
                        </div>
                        <div class='home'>
                            <div class='team'>".$row['home']."</div>
                            <div class='back'><a href='back.php?kind=home&matchid=".$row['id']."'>".$row['homew']."</a></div>
                            <div class='lay'><a href='lay.php?kind=home&matchid=".$row['id']."'>".$row['awayw']."</a></div>
                        </div>
                    ";
                        if($kind=='home'){
                        echo"
                                <div class='back-bet'>
                                    <h6>Back:<strong>".$row['home']."</strong></h6>
                                    <form method='post' action='manage_back.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input name='kind' value='".$kind."' style='display:none;'>
                                        <input name='matchid' value='".$_SESSION['matchId']."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$row['homew']."' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' placeholder='enter money..'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='match_details.php?matchId=".$row['id']."'>CANCEL</a></button>
                                            <button type='submit' name='back-bet'>Place bet</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo"
                        <div class='away'>
                            <div class='team'>".$row['away']."</div>
                            <div class='back'><a href='back.php?kind=away&matchid=".$row['id']."'>".$row['awayw']."</a></div>
                            <div class='lay'><a href='lay.php?kind=away&matchid=".$row['id']."'>".$row['homew']."</a></div>
                        </div>
                    ";
                        if($kind=='away'){
                        echo"
                                <div class='back-bet'>
                                    <h6>Back: <strong>".$row['away']."</strong></h6>
                                    <form method='post' action='manage_back.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input name='kind' value='".$kind."' style='display:none;'>
                                        <input name='matchid' value='".$_SESSION['matchId']."' style='display:none;'>

                                        <input type='number' name='odd' step='0.1' value='".$row['awayw']."' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' value='".$_SESSION['stake']."' step='0.1' placeholder='enter money..'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='over_under.php?matchId=".$row['id']."'>CANCEL</a></button>
                                            <button type='submit' name='back-bet'>Place bet</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo"
                        <div class='draw'>
                            <div class='team'>Draw</div>
                            <div class='back'><a href='back.php?kind=draw&matchid=".$row['id']."'>".$row['draw']."</a></div>
                            <div class='lay'><a href='lay.php?kind=draw&matchid=".$row['id']."'>".$row['draw']."</a></div>
                        </div>
                    ";
                        if($kind=='draw'){
                        echo"
                                <div class='back-bet'>
                                    <h6>Back:<strong>draw</strong></h6>
                                    <form method='post' action='manage_back.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input name='kind' value='".$kind."' style='display:none;'>
                                        <input name='matchid' value='".$_SESSION['matchId']."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$row['draw']."' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' placeholder='enter money..'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='over_under.php?matchId=".$row['id']."'>CANCEL</a></button>
                                            <button type='submit' name='back-bet'>Place bet</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo"
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