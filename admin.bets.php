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

    $sql = "SELECT * FROM users WHERE contact= '".$_SESSION['phone']."'";
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
        <nav>
            <div class="logo">
                <a  href="admin.matches.php">CO. ADMIN</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i style="width: 30px;height: 30px; font-size:large; color: #000;background: #fff;padding: 5px;border-radius: 5px;" class="fas fa-align-justify"></i>
            </button>    
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav m-auto">
                    <li><a href="admin.users.php">USERS</a></li>
                    <li><a href="admin.matches.php">MATCHES</a></li>
                    <li><a href="">BETS</a></li>
                    <li><a href="index.php">SWITCH<a></li>
                </ul>
            </div>
        </nav>
        <main>
            <?php
                foreach($result as $row){
            ?>
            <div class="profile">
                <h4>My Profile</h4>
                <table style="width: 100%;" id="example1" class="table table-bordered">
                    <thead style="width: 100%;">
                        <tr style="width: 100%;">
                            <th style="width: 33%;">Id</th>
                            <th style="width: 33%;">Name</th>
                            <th style="width: 33%;">Contact</th>
                        </tr>
                    </thead>
                    <tbody style="width: 100%;">
                        <tr style="width: 100%;">
                            <td style="width: 33%;"><?php echo $row['id'];?></td>
                            <td style="width: 33%;"><?php echo $row['name'];?></td>
                            <td style="width: 33%;"><?php echo $row['contact'];?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="bets">
                <h4>Lay bets</h4>
                <table style="width: 100%;" id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>HOME</th>
                                <th>Vs</th>
                                <th>AWAY</th>
                                <th>STAKE</th>
                                <th>ODD</th>
                                <th>KIND</th>
                            </tr>
                        </thead>
                <?php
                    $sqlbet="SELECT * FROM lay WHERE userid='".$row['id']."' ";
                    $resultbet=mysqli_query($conn, $sqlbet);
                    if(mysqli_num_rows($resultbet)>0){
                        foreach($resultbet AS $rowbet){
                            $sqlmatch="SELECT * FROM matches WHERE id='".$rowbet['matchid']."' ";
                            $resultmatch=mysqli_query($conn, $sqlmatch);
                            $rowmatch=mysqli_fetch_assoc($resultmatch);
                ?>

                        <tbody">
                            <tr">
                                <td><?php echo $rowmatch['home'];?></td>
                                <td>Vs</td>
                                <td><?php echo $rowmatch['away'];?></td>
                                <td><?php echo $rowbet['stake'];?></td>
                                <td><?php echo $rowbet['odd'];?></td>
                                <td><?php echo $rowbet['kind'];?></td>
                            </tr>
                        </tbody>
                    
                 <?php
                        }
                    }
                    else
                    {
                        echo  'You have no lay bets';
                    }
                ?>
                </table>
            </div>
            <div class="bets">
                <h4>Back bets</h4>
                <table style="width: 100%;" id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>HOME</th>
                                <th>Vs</th>
                                <th>AWAY</th>
                                <th>STAKE</th>
                                <th>ODD</th>
                                <th>KIND</th>
                            </tr>
                        </thead>
                <?php
                    $sqlbet="SELECT * FROM back WHERE userid='".$row['id']."' ";
                    $resultbet=mysqli_query($conn, $sqlbet);
                    if(mysqli_num_rows($resultbet)>0){
                        foreach($resultbet AS $rowbet){
                            $sqlmatch="SELECT * FROM matches WHERE id='".$rowbet['matchid']."' ";
                            $resultmatch=mysqli_query($conn, $sqlmatch);
                            $rowmatch=mysqli_fetch_assoc($resultmatch);
                ?>

                        <tbody>
                            <tr>
                                <td><?php echo $rowmatch['home'];?></td>
                                <td>Vs</td>
                                <td><?php echo $rowmatch['away'];?></td>
                                <td><?php echo $rowbet['stake'];?></td>
                                <td><?php echo $rowbet['odd'];?></td>
                                <td><?php echo $rowbet['kind'];?></td>
                            </tr>
                        </tbody>
                    
                 <?php
                        }
                    }
                    else
                    {
                        echo  'You have no back bets';
                    }
                ?>
                </table>
            </div>
            <div class="wallet">
                <h4>My account</h4>
                <?php
                    $sqlbet="SELECT SUM(amount) as total From account WHERE userid='".$row['id']."' ";
                    $resultbet=mysqli_query($conn, $sqlbet);
                    if(mysqli_num_rows($resultbet)>0){
                        foreach($resultbet AS $rowbet){
                            echo  $rowbet['total'];
                        }
                    }
                    else
                    {
                        echo  'Acount is empty';
                    }
                    
                ?>
                
            </div>

            <?php
                }
            ?>
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