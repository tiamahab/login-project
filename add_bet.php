<?php
    session_start();
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");if(!$conn){die("connection failed:" . mysqli_connect_error());}
    if(isset($_POST['create-bet'])){
        $home=$_POST['home'];
        $away=$_POST['away'];
        $homew=$_POST['homew'];
        $awayw=$_POST['awayw'];
        $draw=$_POST['draw'];
        $over=$_POST['over'];
        $under=$_POST['under'];
        $sql="INSERT INTO matches( home, away, homew, awayw, draw, ov, under, status) 
        VALUES('$home', '$away','$homew','$awayw','$draw','$over','$under','deactivate')";
        $result= mysqli_query($conn, $sql);
        header('location: admin.matches.php');
    }

    if(isset($_POST['update-match'])){
        $id=$_POST['id'];
        $home=$_POST['home'];
        $away=$_POST['away'];
        $homew=$_POST['homew'];
        $awayw=$_POST['awayw'];
        $draw=$_POST['draw'];
        $over=$_POST['over'];
        $under=$_POST['under'];
        $sql="UPDATE matches set home='$home', away='$away', homew='$homew', awayw='$awayw', draw='$draw', ov='$over', under='$under', status='deactivate' WHERE id='$id'"; 
        $result= mysqli_query($conn, $sql);
        header('location: admin.matches.php');
    }
?>
