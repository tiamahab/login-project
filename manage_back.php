<?php
    session_start();
    //connect to the database
    $conn = mysqli_connect("localhost","root", "","brian");
    //checking connection
    if (!$conn) {
        die("connection failed: " . mysqli_connect_error());
    }
    $odd="";
    $stake="";
    if(isset($_POST['back-bet'])){
        $uerid=$_POST['uid'];
        $kind=$_POST['kind'];
        $matchid=$_POST['matchid'];
        $odd=$_POST['odd'];
        $stake=$_POST['stake'];

        if(!empty($odd) && !empty($odd)){
            $_SESSION['odd']=$odd;
            $_SESSION['stake']=$stake;
            $_SESSION['kind']=$kind;
            $_SESSION['matchid']=$matchid;
            header('location: back_confirm.php');
        }
    }

    if(isset($_POST['back-confirm'])){
        $userid=$_POST['uid'];
        $kind=$_SESSION['kind'];
        $matchid=$_SESSION['matchid'];
        $odd=$_POST['odd'];
        $stake=$_POST['stake'];
        $sql="INSERT INTO back( userid, matchid, kind, odd, stake) 
        VALUES('$userid','$matchid','$kind','$odd','$stake')";
        $result= mysqli_query($conn, $sql);
        $_SESSION['success']=='bet successful';
        header('location: match_details.php?matchId='.$matchid);
    }
?>