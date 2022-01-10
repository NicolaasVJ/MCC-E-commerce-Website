<?php 
    include("admin/includes/database.php");

    if(isset($_POST['signup'])) {
        $dbCon = new dbConnect();

        $CustomerName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['name']);
        $CustomerEmail =  mysqli_real_escape_string($dbCon->getConn(),$_POST['email']); 
        $CustomerPassword = mysqli_real_escape_string($dbCon->getConn(), $_POST['password']);
        $CustomerAddress =  mysqli_real_escape_string($dbCon->getConn(),$_POST['address']);
        $CustomerCell =  mysqli_real_escape_string($dbCon->getConn(),$_POST['cell']);
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

        $query = "INSERT INTO customer(name, email, password, address, cellNumber) VALUES ('$CustomerName','$CustomerEmail','$CustomerPassword','$CustomerAddress','$CustomerCell')";

        


        $execute = $dbCon->query($query);

        if($execute) {
            echo "<script>window.history.back();</script>";
        } 
        else {

            echo "<script>alert('Registration failed')</script>";

            echo "<script>window.history.back();</script>";


        }
    }

    }
?>