<?php 
    session_start();
    include("admin/includes/database.php");
    if(isset($_POST['login'])) {
        $dbCon = new dbConnect();

        $email = mysqli_real_escape_string($dbCon->getConn(),$_POST['email']);
        $password = mysqli_real_escape_string($dbCon->getConn(),$_POST['password']);

        $query = "SELECT userID FROM customer WHERE email='$email' AND password='$password'";

        $execute = $dbCon->query($query);

        $count = mysqli_num_rows($execute);
        $row = mysqli_fetch_array($execute);

        $dbCon->closeConnect();
        
        if($count == 1) {
            $result = count($row);
            $userID = $row['userID'];
            $_SESSION['user_id'] = $userID;
            $_SESSION['user_email'] = $email;
			

            echo "<script>window.history.back();</script>";

        } 
        else {

            echo "<script>alert('Email Address Or Password Incorrect')</script>";

            echo "<script>window.history.back();</script>";

        }
	}


?>
