<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['delete_product'])){

        $ID =  mysqli_real_escape_string($dbCon->getConn(),$_GET['delete_product']);

        $Query = "DELETE FROM product WHERE productID='$ID'";

        $executeDel = $dbCon->query($Query);

        if($executeDel){

           

            echo "<script>window.open('index.php?view_product','_self')</script>";

        }
        else {

            echo "<script>alert('Deletion Failed')</script>";
        }

    }
}
?>