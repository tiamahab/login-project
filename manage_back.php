<?php
    session_start();
    //connect to the database
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");
if(!$conn){
die("connection failed:" . mysqli_connect_error());
}
    $odd="";
    $stake="";
    if(isset($_POST['back-bet'])){
        $uerid=$_POST['uid'];
        $kind=$_POST['kind'];
        $matchid=$_POST['matchid'];
        $odd=$_POST['odd'];
        $stake=$_POST['stake'];
        if(!empty($odd) && !empty($stake)){
            if($stake < 500){
                $_SESSION['error']='min stake is UGX: 500';
                header('location: back.php?kind='.$kind.'&matchid='.$matchid);
            }
            else
            {
                $sqlbet="SELECT SUM(amount) as total From account WHERE userid='$userid' ";
                $resultbet=mysqli_query($conn, $sqlbet);
                $rowbet=mysqli_fetch_assoc($resultbet);
                if($rowbet['total'] < $stake){
                    $_SESSION['error']='you dont have enough';
                    header('location: back.php?kind='.$kind.'&matchid='.$matchid);
                }
                else
                {
                    $_SESSION['odd']=$odd;
                    $_SESSION['stake']=$stake;
                    $_SESSION['kind']=$kind;
                    $_SESSION['matchid']=$matchid;
                    header('location: back_confirm.php');
                }

            }
        }
    }

    if(isset($_POST['back-confirm'])){
        $userid=$_POST['uid'];
        $kind=$_SESSION['kind'];
        $matchid=$_SESSION['matchid'];
        $odd=$_POST['odd'];
        $stake=$_POST['stake'];
        $win=$_POST['win'];
        $tax=$_POST['tax'];
        $return=$_POST['return'];
        $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code=substr(str_shuffle($set), 0, 12);
        $ref='BACK_BET_'.$code;
        if($stake>500){
            $sql="INSERT INTO back( userid, matchid, kind, odd, stake,winnings,tax,retrn,status) 
            VALUES('$userid','$matchid','$kind','$odd','$stake','$win','$tax','$return','pending')";
            mysqli_query($conn, $sql);
            $sqlacc="INSERT INTO account(userid,amount,transID) 
                        VALUES('$userid','-$stake','$ref')";
            mysqli_query($conn, $sqlacc);

            unset($_SESSION['kind']);
            unset($_SESSION['matchid']);
            unset($_SESSION['odd']);
            $_SESSION['success']=='bet successful';
            header('location: match_details.php?matchId='.$matchid);
        }
        else
        {
            $_SESSION['error']=='min stake is UGX: 500';
            header('location: match_details.php?matchId='.$matchid);
        }
    }
?>
