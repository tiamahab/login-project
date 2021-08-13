<?php
    session_start();
    Class Database{
	
        private $server = "mysql:host=mi3-sr2.byarufashionworld.com;dbname=byarufashion_byarufw";
        private $username = "byarufashion@byarufashionworld.com";
        private $pass ="3DlK5_{F4RWy";
        private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	

        protected $conn;
         
        public function open(){
             try{
                 $this->conn = new PDO($this->server, $this->username, $this->pass, $this->options);
                 return $this->conn;
             }
             catch (PDOException $e){
                 echo "There is some problem in connection: " . $e->getMessage();
             }
     
        }
     
        public function close(){
               $this->conn = null;
         }
     
    }
    $pdo = new Database();

    $name = "";
    $email ="";
    $contact = "";
    $password="";
    $password1 ="";
    $password2 ="";

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
                $conn = $pdo->open();
                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
                $stmt->execute(['email'=>$email]);
                $row = $stmt->fetch();		
                if($row['numrows'] ==0)
                {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (name, email, contact, password) VALUES (:name, :email, :contact, :password)");
                    $stmt->execute(['name'=>$name,'email'=>$email, 'contact'=>$contact, 'password'=>$password ]);
                    $userid = $conn->lastInsertId();
                    $_SESSION['email']=$email;
                    $_SESSION['name'] = $name;
                    header('location: home.php');
                    $pdo->close();
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

        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch();
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
	$pdo->close();


