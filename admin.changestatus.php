<?php
        //connect to the database
        $conn = mysqli_connect("localhost","root", "","brian");
        //checking connection
        if (!$conn) {
              die("connection failed: " . mysqli_connect_error());
        }
    $status=$_GET['status'];
    $id=$_GET['id'];
    if($status=='deactivate'){
        $sql="UPDATE matches  SET status='activate' WHERE id='".$id."'";
        $result= mysqli_query($conn, $sql);
        header('location: admin.matches.php');
    }
    else
    {
        $sql="UPDATE matches  SET status='deactivate' WHERE id='".$id."'";
        $result= mysqli_query($conn, $sql);
        header('location: admin.matches.php');
    }
?>