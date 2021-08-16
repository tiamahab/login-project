<?php
    session_start();
    //connect to the database
    $conn = mysqli_connect("localhost","root", "","brian");
    //checking connection
    if (!$conn) {
          die("connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST['create-bet'])){
        $home=$_POST['home'];
        $away=$_POST['away'];
        $homew=$_POST['homew'];
        $awayw=$_POST['awayw'];
        $draw=$_POST['draw'];
        $over=$_POST['over'];
        $under=$_POST['under'];
        $sql="INSERT INTO matches( home, away, homew, awayw, draw, ov, under) 
        VALUES('$home', '$away','$homew','$awayw','$draw','$over','$under')";
        $result= mysqli_query($conn, $sql);
        header('location: home1.php');
    }
    else{
        header('location: logout.php');
    }
?>