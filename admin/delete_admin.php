<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['delete_admin'])) {

        $adminId =  mysqli_real_escape_string($dbCon->getConn(),$_GET['delete_admin']);

        $deleteQuery = "DELETE from admin WHERE ID='$adminId'";


        $executeQuery = $dbCon->query($deleteQuery);

        if($executeQuery) {

            echo "<script>window.open('index.php?view_admin','_self')</script>";
        }
        else {

            echo "<script>alert('Deletion Failed')</script>";
        }
    }
}

?>
