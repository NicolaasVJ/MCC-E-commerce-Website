<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['lock_customer'])){

        $ID =  mysqli_real_escape_string($dbCon->getConn(),$_GET['lock_customer']);

        $Query = "UPDATE customer SET status='LOCKED' WHERE userID='$ID'";

        $execQ = $dbCon->query($Query);

        if($execQ){

            echo "<script>window.open('index.php?view_customer','_self')</script>";

        }

    }   
}
?>