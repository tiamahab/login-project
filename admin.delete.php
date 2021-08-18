<?php
    //connect to the database
    $conn = mysqli_connect("localhost","root", "","brian");
        //checking connection
    if (!$conn) {
              die("connection failed: " . mysqli_connect_error());
    }
    $id=$_GET['id'];

    $sql="DELETE FROM users WHERE id='".$id."'";
    $result= mysqli_query($conn, $sql);
    header('location: admin.users.php');
?>