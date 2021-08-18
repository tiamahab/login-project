<?php
    session_start();
    if(!isset($_SESSION['phone'])){
        header('location: logout.php');
    }
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}
    $id=$_GET['id'];
    $sql="SELECT * FROM matches WHERE id='".$id."'";
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
        <main>
            <div class="form-container">
                <h4>UPDATE MATCH</h4>
                <form  method="post" action="add_bet.php">
                    <h5>Enter teams for the exchange</h5>
                    <input type="text" name="id" value="<?php echo $id ?>" style="display: none;">
                    <div class="input-group">
                        <label>
                            Home team
                        </label>
                        <input type="text" name="home" value="<?php echo $row['home'] ?>" placeholder="Enter home team name...">
                    </div>
                    <div class="input-group">
                        <label>
                            Away team
                        </label>
                        <input type="text" name="away" value="<?php echo $row['away'] ?>" placeholder="Enter away team name...">
                    </div>
                    <h5>Enter odds for draw win /lose</h5>
                    <div class="input-group">
                        <label>
                            Home win
                        </label>
                        <input type="number" name="homew" value="<?php echo $row['homew'] ?>"step="0.1" placeholder="Set home win odd..">
                    </div>
                    <div class="input-group">
                        <label>
                            Draw
                        </label>
                        <input type="number" name="draw" step="0.1" value="<?php echo $row['draw']; ?>" placeholder="Set  draw odd..">
                    </div>
                    <div class="input-group">
                        <label>
                            Away win
                        </label>
                        <input type="number" name="awayw" step="0.1" value="<?php echo $row['awayw']; ?>" placeholder="Set  away win odd..">
                    </div>
                    <h5>Enter odds for over /under</h5>
                    <div class="input-group">
                        <label>
                            Over
                        </label>
                        <input type="number" name="over"  step="0.1" placeholder="Set over odd.." value="<?php echo $row['ov']; ?>">
                    </div>
                    <div class="input-group">
                        <label>
                            Under
                        </label>
                        <input type="number" name="under" value="<?php echo $row['under']; ?>" step="0.1" placeholder="Set under odd..">
                    </div>
                    <br>
                    <button type="submit" name="update-match">UPDATE</button>
                </form>
            </div>
        </main>
        
        <script src="jquery.1.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="all.js"></script>
    </body>
</html>
