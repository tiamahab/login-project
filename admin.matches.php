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
    $sql = "SELECT * FROM matches ORDER BY id DESC";
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
            <div class="profile">
                <h4>MATCHES</h4>
                <a href="admin.managematch.php">ADD MATCH</a>
                <table id="example1" class="table table-bordered">
                <thead>
                  <th>Id</th>
                  <th>HOME</th>
                  <th>AWAY</th>
                  <th>STATUS</th>
                  <th>EDIT</th>
                </thead>
                <tbody>
                  <?php
                      foreach($result as $row){
                        echo "
                          <tr>
                            <td>".$row['id']." </td>
                            <td>".$row['home']."</td>
                            <td>".$row['away']."</td>
                            <td><a href='admin.changestatus.php?status=".$row['status']."&id=".$row['id']."'>".$row['status']."</a></td>
                            <td><a href='admin.editmatch.php?id=".$row['id']."'>EDIT</a></td>
                          </tr>
                        ";
                      }
                    ?>
                </tbody>
              </table>
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
