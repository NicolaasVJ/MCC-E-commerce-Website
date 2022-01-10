<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {
    
    if(isset($_GET['edit_customer'])) {

        $cID = $_GET['edit_customer'];

        $iquery = "select * from customer where userID='$cID'";

        $run_query = $dbCon->query($iquery);

        $CurInfo = mysqli_fetch_array($run_query);

        $current_id = $CurInfo['userID'];
        $current_name = $CurInfo['name'];
        $current_email = $CurInfo['email'];
        $current_password = $CurInfo['password'];
        $current_address =  $CurInfo['address'];   
        $current_cellNumber =   $CurInfo['cellNumber'];
        }

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-edit"></i> Edit Customer Information</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Customer ID:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="customerID" required value="<?php echo $current_id; ?>"readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Customer Name:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" required value="<?php echo $current_name; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Email:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" required value="<?php echo $current_email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Password:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="password" required value="<?php echo $current_password; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Address:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="address" required value="<?php echo $current_address; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Cell Number:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="cellNumber" required value="<?php echo $current_cellNumber; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="update" value="Update Customer Information" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
    if(isset($_POST['update'])) {
      
        $NewName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['name']);
        $NewEmail =  mysqli_real_escape_string($dbCon->getConn(),$_POST['email']);
        $NewPassword =  mysqli_real_escape_string($dbCon->getConn(),$_POST['password']);
        $NewAddress =   mysqli_real_escape_string($dbCon->getConn(),$_POST['address']);   
        $NewCellNumber =    mysqli_real_escape_string($dbCon->getConn(),$_POST['cellNumber']);

        $Query = "UPDATE customer set name='$NewName', email='$NewEmail',password='$NewPassword',cellNumber='$NewCellNumber',address='$NewAddress' WHERE userID='$current_id'";
        
        $executeQ = $dbCon->query($Query);

        if($executeQ) {
           

            echo "<script>window.open('index.php?view_customer','_self')</script>";
        }
        else{
            echo "<script>alert('Update failed')</script>";
        }
    }



?>

<?php } ?>