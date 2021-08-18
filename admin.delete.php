<?php
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}
    $id=$_GET['id'];

    $sql="DELETE FROM users WHERE id='".$id."'";
    $result= mysqli_query($conn, $sql);
    header('location: admin.users.php');
?>
