<?php 
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }

    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}
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
            <nav>
                <div class="logo">
                    <a  href="home1.php">CO. NAME</a>
                </div>
                <div class="name">
                    <a href="profile.php?phone=<?php echo $_SESSION['phone'];?>" ><?php echo $_SESSION['username'];?></a>
                </div>
            </nav>
        </header>
        <div class="fixed-navigation">
            <div class="item">
                <a href="home1.php">
                    <i style="margin-left: 45%;color: crimson;" class="fas fa-home"></i>
                    <span>HOME</span> 
                </a>
            </div>
            <div class="item">
                <a href="home1.php">
                    <i style="margin-left: 45%;color: crimson;" class="fas fa-wallet"></i>
                    <span>Balance</span> 
                </a>
            </div>
            <div class="item">
                <a href="mybets.php">
                    <i style="margin-left: 45%;color: crimson;" class="fas fa-briefcase"></i>
                    <span>My bets</span> 
                </a>
            </div>
            <div class="item">
                <a href="logout.php">
                    <i style="margin-left: 45%;color: crimson;" class="fas fa-times"></i>
                    <span>Logout</span> 
                </a>
            </div>
        </div>
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
                            <div class='back'><a href='over_under_back.php?kind=over&matchid=".$row['id']."'>".$row['ov']."</a></div>
                            <div class='lay'><a href='over_under_lay.php?kind=over&matchid=".$row['id']."'>".$row['under']."</a></div>
                        </div>
                    ";
                        if($kind=='over'){
                        echo"
                                <div class='lay-bet'>
                                    <h6>Lay (bet Against):<strong>OVER</strong></h6>
                                    <form method='post' action='manage_over_under.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input name='kind' value='".$kind."' style='display:none;'>
                                        <input name='matchid' value='".$_SESSION['matchId']."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$row['under']."'>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' placeholder='enter money..'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='match_details.php?matchId=".$row['id']."'>CANCEL</a></button>
                                            <button type='submit' name='lay-over-under'>Place bet</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo"
                        <div class='away'>
                            <div class='team'>UNDER</div>
                            <div class='back'><a href='over_under_back.php?kind=under&matchid=".$row['id']."'>".$row['under']."</a></div>
                            <div class='lay'><a href='over_under_lay.php?kind=under&matchid=".$row['id']."'>".$row['ov']."</a></div>
                        </div>
                    ";
                        if($kind=='under'){
                        echo"
                                <div class='lay-bet'>
                                    <h6>Lay (bet Against):<strong>UNDER</strong></h6>
                                    <form method='post' action='manage_over_under.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input name='kind' value='".$kind."' style='display:none;'>
                                        <input name='matchid' value='".$_SESSION['matchId']."' style='display:none;'>

                                        <input type='number' name='odd' step='0.1' value='".$row['under']."'>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' value='".$_SESSION['stake']."' step='0.1' placeholder='enter money..'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='match_details.php?matchId=".$row['id']."'>CANCEL</a></button>
                                            <button type='submit' name='lay-over-under'>Place bet</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo "</div>";
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
