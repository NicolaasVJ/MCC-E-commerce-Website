<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['delete_order'])){

        $ID =  mysqli_real_escape_string($dbCon->getConn(),$_GET['delete_order']);

        $QueryC = "DELETE from c_order WHERE orderID='$ID'";

        $executeDel = $dbCon->query($QueryC);

            $QueryO = "DELETE from orders WHERE orderID='$ID'";

            $executeDel = $dbCon->query($QueryO);

            if($executeDel){

                echo "<script>window.open('index.php?view_order','_self')</script>";
    
            }



        

    }   
}
?>