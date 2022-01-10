<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['delete_customer'])){

        $ID =  mysqli_real_escape_string($dbCon->getConn(),$_GET['delete_customer']);

        $DEL = "DELETE FROM customer WHERE userID='$ID'";

        $executeQuery = $dbCon->query($DEL);

        if($executeQuery){

           

            echo "<script>window.open('index.php?view_customer','_self')</script>";

        }
        else {

            echo "<script>alert('Deletion Failed')</script>";
        }

    }
}
?>