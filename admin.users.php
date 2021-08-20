<?php
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }

    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}


    $sql = "SELECT * FROM users ORDER BY id DESC";
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
                <h4>USERS</h4>
                <table id="example1" class="table table-bordered">
                <thead>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Delete</th>
                  <th>Details</th>
                  <th>Account</th>
                </thead>
                <tbody>
                  <?php
                      foreach($result as $row){
                        echo "
                          <tr>
                            <td>".$row['id']." </td>
                            <td>".$row['name']."</td>
                            <td>".$row['contact']."</td>
                            <td><a href='admin.userprofile.php?phone=".$row['contact']."'>View</a></td>
                            <td><a href='admin.delete.php?id=".$row['id']."'>delete</a></td>
                            <td><a href='admin.credituser.php?phone=".$row['contact']."'>Credit</a></td>
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
