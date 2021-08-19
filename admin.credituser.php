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
    if(isset($_POST['credit-user'])){
        $uid=$_POST['uid'];
        $amount=-$_POST['amount'];
        $sqlamount="INSERT INTO account( userid, amount) 
        VALUES('$uid', '$amount')";
        $result= mysqli_query($conn, $sqlamount);
        header('location: admin.credituser.php?id='.$uid);
    }
    $id=$_GET['id'];
    $sql="SELECT * FROM users WHERE id='".$id."'";
    $result= mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
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
            <div class="credit-form">
                <h5>CREDIT <?php echo strtoupper($row['name']); ?>'s ACCOUNT</h5>

                <form  method="post" action="admin.credituser.php">
                    <input type="text" name="uid" value="<?php echo $id ?>" style="display: none;">
                    <div class="input-group">
                        <label>
                            AMOUNT
                        </label>
                        <input type="number" name="amount" step="0.1" placeholder="enter amount..">
                    </div>
                    <br>
                    <button type="submit" name="credit-user">CONFIRM</button>
                </form>
                <div class="account">
                    <?php
                        $sqlbet="SELECT SUM(amount) as total From account WHERE userid='$id' ";
                        $resultbet=mysqli_query($conn, $sqlbet);
                        if(mysqli_num_rows($resultbet)>0){
                            foreach($resultbet AS $rowbet){
                                if($rowbet['total']!=0){
                        ?>
                            <div class="balance">
                                <span>Balance:</span> UGX <?php echo  $rowbet['total'];?>
                            </div>
                        <?php
                                }
                                else
                                {
                                ?>
                                    <div class="balance">
                                        <span>Balance: </span>UGX 0.0
                                    </div>
                                <?php
                                }
                                
                            }
                        }
                        else
                        {
                        ?>
                            <div class="balance">
                            <span>Balance:</span> <?php echo  $row['name'];?>'s Acount is empty.
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
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