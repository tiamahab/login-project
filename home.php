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
    $sql="SELECT * FROM matches ORDER BY id desc";
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
            <input type="checkbox" id="toggle">
            <label for="toggle" id="add-link" title="create bet">
                <a href=""><i class="fas fa-plus"></i></a>
            </label>

            <section>
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Home</th>
                        <th>vs</th>
                        <th>Away</th>
                        <th>Back</th>
                        <th>Lay</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while($row=mysqli_fetch_assoc($result)){?>
                    <tr>
                        <td><?php echo $row['home']?></td>
                        <td>vs</td>
                        <td><?php echo $row['away']?></td>
                        <td><?php echo $row['under']?></td>
                        <td><?php echo $row['over']?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section>
            <div class="form-container">
                <label for="toggle" class="cancel-btn"><i class="fas fa-times"></i></label>
                <h3>CREATE BET</h3>
                <form action="add_bet.php" method="post">
                    <h5>Enter teams for the exchange</h5>
                    <div class="input-group">
                        <label>
                            Home team
                        </label>
                        <input type="text" name="home" placeholder="Enter home team name...">
                    </div>
                    <div class="input-group">
                        <label>
                            Away team
                        </label>
                        <input type="text" name="away" placeholder="Enter away team name...">
                    </div>
                    <h5>Enter odds for draw win /lose</h5>
                    <div class="input-group">
                        <label>
                            Home win
                        </label>
                        <input type="number" name="homew" step="0.1" placeholder="Set home win odd..">
                    </div>
                    <div class="input-group">
                        <label>
                            Draw
                        </label>
                        <input type="number" name="draw" step="0.1" placeholder="Set  draw odd..">
                    </div>
                    <div class="input-group">
                        <label>
                            Away win
                        </label>
                        <input type="number" name="awayw" step="0.1" placeholder="Set  away win odd..">
                    </div>
                    <h5>Enter odds for over /under</h5>
                    <div class="input-group">
                        <label>
                            Over
                        </label>
                        <input type="number" name="over" step="0.1" placeholder="Set over odd..">
                    </div>
                    <div class="input-group">
                        <label>
                            Under
                        </label>
                        <input type="number" name="under" step="0.1" placeholder="Set under odd..">
                    </div>
                    <br>
                    <button type="submit" name="create-bet">Create</button>
                </form>
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