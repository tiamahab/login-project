<?php
    session_start();
$conn="";
$name = "";
    $email ="";
    $contact = "";
    $password="";
    $password1 ="";
    $password2 ="";
    $conn=mysqli_connect("sql5.freesqldatabase.com","sql5430872","QRNB4IUK2P","sql5430872");
if(!$conn){
die("connection failed:" . mysqli_connect_error());
}

    

    //register user
    if(isset($_POST['signup'])){
		$name = $_POST['fullName'];
		$email = $_POST['email'];
        $contact = $_POST['phone'];
		$password1 = $_POST['pwd1'];
		$password2 = $_POST['pwd2'];

		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;


		if($password1 == $password2){
            if(strlen($contact)==10){
                
                $sql ="SELECT COUNT(*) AS numrows FROM users WHERE email='$email'");
                $result=mysqli_query($conn, $sql);
                $row= mysqli_fetch_array($tesult);		
                if($row['numrows'] ==0)
                {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $sqlinsert ="INSERT INTO users (name, email, contact, password) VALUES ('$name', '$email', '$contact', '$password')";
                    $resultinsert=mysqli_query($conn, $sqlinsert);
                    
                    $_SESSION['email']=$email;
                    $_SESSION['name'] = $name;
                    header('location: home.php');
                    
                }
                else
                {
                    $_SESSION['error'] = 'Email already exists';
                    header('location: signup.php');
                }
            }
            else
            {
                $_SESSION['error'] = 'contact should be 10 digits';
                header('location: signup.php');
            }
		}
		else
        {
            $_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
        }

	}

    //login
    if(isset($_POST['login'])){
		$email = $_POST['email'];
        $_SESSION['email']=$email;
		$password = $_POST['pwd'];

        
        $query ="SELECT *, COUNT(*) AS numrows FROM users WHERE email ='$email'";
        $check=mysqli_query($conn, $query);
        $row =mysqli_fetch_array($check);
        if($row['numrows'] > 0){
                if(password_verify($password, $row['password'])){
                    header('location: home.php');
                }
                else
                {
                    $_SESSION['error'] = 'Incorrect Password';
                    header('location:login.php');
                    
                }
        }
        else
        {
            $_SESSION['error'] = 'Email not found';
            header('location:login.php?Emailnotfound');
            
        }

	}
	
?>

