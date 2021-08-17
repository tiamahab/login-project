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

    $kind=$_SESSION['kind'];
    $id=$_SESSION['matchid'];

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
                        <div id='banner'>
                            <div class='odd'><a class='active' href='match_details.php?matchId=".$_SESSION['matchId']."'>Match odds</a></div>
                            <div class='over'><a href='over_under.php?matchId=".$_SESSION['matchId']."'>Over / Under</a></div>
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
                                <div class='lay-bet'>
                                    <h6>Lay (bet Against):<strong>".$row['home']."</strong></h6>
                                    <form method='post' action='manage_lay.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$_SESSION['odd']."' style='background:transparent; border:none;' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' value='".$_SESSION['stake']."' readonly style='background:transparent; border:none;'>
                                        </div>
                                        
                                        <div class='buttons'>
                                        <button class='link'><a href='lay.php?kind=home&matchid=".$id."'>EDIT</a></button>
                                        <button type='submit' name='lay-confirm'>CONFIRM BET</button>
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
                                <div class='lay-bet'>
                                    <h6>Lay (bet Against):<strong>".$row['away']."</strong></h6>
                                    <form method='post' action='manage_lay.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$_SESSION['odd']."' style='background:transparent; border:none;' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' value='".$_SESSION['stake']."' readonly style='background:transparent; border:none;'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='lay.php?kind=away&matchid=".$id."'>EDIT</a></button>
                                            <button type='submit' name='lay-confirm'>CONFIRM BET</button>
                                        </div>
                                    </form>
                                </div>
                            ";
                        }
                echo"
                        <div class='draw'>
                            <div class='team'>Draw</div>
                            <div class='back'><a href='back.php?kind=draw&matchid=".$row['id']."'>".$row['under']."</a></div>
                            <div class='lay'><a href='lay.php?kind=draw&matchid=".$row['id']."'>".$row['draw']."</a></div>
                        </div>
                    ";
                        if($kind=='draw'){
                        echo"
                                <div class='lay-bet'>
                                    <h6>Lay (bet Against):<strong>draw</strong></h6>
                                    <form method='post' action='manage_lay.php'>
                                        <input name='uid' value='".$userid."' style='display:none;'>
                                        <input type='number' name='odd' step='0.1' value='".$_SESSION['odd']."' style='background:transparent; border:none;' readonly>
                                        <div class='stake'>
                                            <span>UGX:</span><input type='number' name='stake' step='0.1' value='".$_SESSION['stake']."' readonly style='background:transparent; border:none;'>
                                        </div>
                                        
                                        <div class='buttons'>
                                            <button class='link'><a href='lay.php?kind=draw&matchid=".$id."'>EDIT</a></button>
                                            <button type='submit' name='lay-confirm'>CONFIRM BET</button>
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
