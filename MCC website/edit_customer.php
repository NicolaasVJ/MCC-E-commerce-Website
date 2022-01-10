<?php

session_start();

include("admin/includes/database.php");
$dbCon = new dbConnect();

    if(isset($_POST['confirm'])) {
        $dbCon = new dbConnect(); 
        $userID = $_SESSION['user_id'];
        
        $CustomerName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['name']);
        $CustomerEmail =  mysqli_real_escape_string($dbCon->getConn(),$_POST['email']); 
        $CustomerPassword =  mysqli_real_escape_string($dbCon->getConn(),$_POST['password']);
        $CustomerAddress =  mysqli_real_escape_string($dbCon->getConn(),$_POST['address']);
        $CustomerCell =  mysqli_real_escape_string($dbCon->getConn(),$_POST['cell']);

        // Remove all illegal characters from email
        $CustomerEmail = filter_var( $CustomerEmail, FILTER_SANITIZE_EMAIL);


// Validate password strength
$uppercase = preg_match('@[A-Z]@',  $CustomerPassword);
$lowercase = preg_match('@[a-z]@',  $CustomerPassword);
$number    = preg_match('@[0-9]@',  $CustomerPassword);
$specialChars = preg_match('@[^\w]@', $CustomerPassword);

   
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen( $CustomerPassword) < 8) {
    echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character')</script>";
    echo "<script>window.history.back();</script>";
    
}
else{
        $q = "UPDATE customer SET name='$CustomerName', email='$CustomerEmail', password='$CustomerPassword', address='$CustomerAddress', cellNumber='$CustomerCell' WHERE customer.userID=$userID";

        $ex = $dbCon->query($q);
    
        if($ex) {

            echo "<script>window.open('logout.php','_self')</script>";
        } 
        else {

            echo "<script>alert('Alterations failed')</script>";
            echo "<script>window.history.back();</script>";
        }
        }
       
}
?>