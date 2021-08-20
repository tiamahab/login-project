<?php
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}

    if(isset($_GET['phne'])&& isset($_GET['ref']) && isset($_GET['amount'])){
        $number=$_GET['phne'];
        $amount=-$_GET['amount'];
        $ref=$_GET['ref'];
        $sql="SELECT * FROM users WHERE contact='$number'";
        $res= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        $uid=$row['id'];
        $sqlamount="INSERT INTO account( userid, amount,transID)
        VALUES('$uid', '$amount','$ref')";
        $result= mysqli_query($conn, $sqlamount);
        header('location: admin.credituser.php?phone='.$number);
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

                <form action=""  method="post" id="payForm">
                
                    <input type="text" id="fullName" value="<?php echo $row['name'] ?>" style="display: none;">
                    <input type="text" id="phoneNumber" value="<?php echo $row['contact']?>" style="display: none;">
                    <div class="input-group">
                        <label>
                            AMOUNT
                        </label>
                        <input type="number" id="amount" name="amount" step="0.1"  placeholder="enter amount..">
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
         <script src="https://checkout.flutterwave.com/v3.js"></script>
        <script>
            //subscription
            const form =document.getElementById("payForm");
            form.addEventListener("submit", payNow);

            function payNow(e){
                //prevent Normal Form submit
                e.preventDefault();

                //set configuration
                FlutterwaveCheckout({
                    public_key:"FLWPUBK_TEST-f46a1292340a259e694bdf5c17a6a254-X",
                    tx_ref:"BET_CO_"+Math.floor((Math.random()*1000000000)+1),
                    amount: document.getElementById("amount").value,
                    currency:"UGX",
                    customer:{
                        email:"tiamahab@gmai.com",
                        phonenumber:document.getElementById("phoneNumber").value,
                        name:document.getElementById("fullName").value
                    },
                    callback: function(data){
                        console.log(data);
                        window.location = 'admin.credituser.php?ref='+data.tx_ref+'&phne='+data.customer.phone_number+'&amount='+data.amount;
                    },
                    customizations: {
                        'title':'BETTING COMPANY',
                        'description':'Crediting user account'
                    }
                });
            }
        </script>
    </body>
</html>
