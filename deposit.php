<?php
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }
    //connect to the database
    $conn=mysqli_connect("sql4.freesqldatabase.com","sql4432075","Sr37jBwi8s","sql4432075");
	if(!$conn){
		die("connection failed:" . mysqli_connect_error());
	}

    if(isset($_GET['phne'])&& isset($_GET['ref']) && isset($_GET['amount'])){
        $number=$_GET['phne'];
        $amount=$_GET['amount'];
        $ref=$_GET['ref'];
        $sql="SELECT * FROM users WHERE contact='$number'";
        $res= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        $uid=$row['id'];
        $sqlamount="INSERT INTO account( userid, amount,transID)
        VALUES('$uid', '$amount','$ref')";
        $result= mysqli_query($conn, $sqlamount);
        header('location: deposit.php?phone='.$number);
    }
    $phone=$_GET['phone'];
    $sql="SELECT * FROM users WHERE contact='".$phone."'";
    $result= mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $id=$row['id'];
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i style="width: 30px;height: 30px; font-size:large; color: #000;background: #fff;padding: 5px;border-radius: 5px;" class="fas fa-align-justify"></i>
                </button>    
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav m-auto">
                        <li><a href=""><span><i class="fas fa-user-edit"></i></span> Update Profile</a></li>
                        <li><a href="deposit.php?phone=<?php echo $_SESSION['phone'];?>"><span><i class="fas fa-funnel-dollar"></i></span> Deposit</a></li>
                        <li><a href="#"><span><i class="fas fa-money-bill-alt"></i></span> Withdraw</a></li>
                    </ul>
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
            <div class="credit-form">
                <h5>Deposit on your acount</h5>
                
                <form action="managecash.php"  method="post" id="payForm">
                
                    <input type="text" id="fullName" value="<?php echo $row['name'] ?>" style="display: none;">
                    <input type="text" name="phoneNumber" value="<?php echo $row['contact']?>" style="display: none;">
                    <div class="input-group">
                        <label>
                            AMOUNT
                        </label>
                        <input type="number" id="amount" name="amount" step="0.1"  placeholder="enter amount..">
                    </div>
                    <br>
                    <button type="submit" name="deposit">CONFIRM</button>
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
                                <span>Current Balance:</span> UGX<?php echo  $rowbet['total'];?>
                            </div>
                        <?php
                                }
                                else
                                {
                                ?>
                                    <div class="balance">
                                        <span>Current Balance: UGX</span>UGX 0.0
                                    </div>
                                <?php
                                }
                                
                            }
                        }
                        else
                        {
                        ?>
                            <div class="balance">
                            <span><?php echo  $row['name'];?>'s</span>  Acount is empty.
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
