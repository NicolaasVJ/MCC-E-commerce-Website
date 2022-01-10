<?php
session_start();

include("includes/database.php");
if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>
<?php

$dbCon = new dbConnect();
$AdminSess = $_SESSION['admin_email'];


$Query = "select * from admin where Email='$AdminSess'";


$execQ = $dbCon->query($Query);

//Admin Information

$resAdmin = mysqli_fetch_array($execQ);

$adminId = $resAdmin['ID'];

$adminName = $resAdmin['Name'];

$adminEmail = $resAdmin['Email'];

$adminAddress = $resAdmin['Address'];

$adminPosition = $resAdmin['Position'];

$adminCell = $resAdmin['cellNumber'];

$adminInformation = $resAdmin['About'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top" >
 
    <div id="wrapper" >
    <?php include("leftbar.php");  ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content"class="py-5">
                <div class="container-fluid">
                    <?php
                    if(isset($_GET['dashboard'])) {
                        include("dashboard.php");
                    }


                    //Products
                    else if(isset($_GET['insert_product'])) {
                        include("insert_product.php");
                    }

                    else if(isset($_GET['view_product'])) {
                        include("view_product.php");
                    }

                    else if(isset($_GET['edit_product'])) {
                        include("edit_product.php");
                    }

                    else if(isset($_GET['delete_product'])) {
                        include("delete_product.php");
                    }

                    //Orders
                    else if(isset($_GET['view_order'])) {
                        include("view_order.php");
                    }
                    else if(isset($_GET['delete_order'])) {
                        include("delete_order.php");
                    }
                    else if(isset($_GET['view_order_detail'])) {
                        include("view_order_detail.php");
                    }
                    else if(isset($_GET['edit_status'])) {
                        include("view_order_detail.php");
                    }

                    //Customer
                    else if(isset($_GET['view_customer'])) {
                        include("view_customer.php");
                    }
                    else if(isset($_GET['edit_customer'])) {
                        include("edit_customer.php");
                    }
                    else if(isset($_GET['lock_customer'])) {
                        include("lock_customer.php");
                    }
                    else if(isset($_GET['unlock_customer'])) {
                        include("unlock_customer.php");
                    }      
                    else if(isset($_GET['delete_customer'])) {
                        include("delete_customer.php");
                    }
                    
                    

                    //Admin
                    else if(isset($_GET['insert_admin'])) {
                        include("insert_admin.php");
                    }
                    
                    else if(isset($_GET['view_admin'])) {
                        include("view_admin.php");
                    }
                    
                    else if(isset($_GET['edit_admin'])) {
                        include("edit_admin.php");
                    }
                    else if(isset($_GET['delete_admin'])) {

                        include("delete_admin.php");
                    }
                    else if(isset($_GET['update_admin'])) {
                        include("update_admin.php");
                    }
                    else if(isset($_GET[''])) {
                        include("dashboard.php");
                    }
                    else {
                        include("dashboard.php");
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
                <div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables.js"></script>

</body>

</html>

<?php } ?>