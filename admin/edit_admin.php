<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {
    
    if(isset($_GET['edit_admin'])) {

        $adminId = $_GET['edit_admin'];

        $query = "select * from admin where ID='$adminId'";

        $run_query = $dbCon->query($query);

        $CurRes = mysqli_fetch_array($run_query);

        $currentID = $CurRes['ID'];
        $currentName = $CurRes['Name'];
        $currentEmail = $CurRes['Email'];
        $currentPassword = $CurRes['Password'];
        $currentCell = $CurRes['cellNumber'];
        $currentAddress = $CurRes['Address'];
        $currentPosition = $CurRes['Position'];
        $currentDesc = $CurRes['About'];

        }

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-edit"></i> Edit Admin Information</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Admin name:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_name" required value="<?php echo $currentName; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Admin Code:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_id" required value="<?php echo $currentID; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Email:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_email" required value="<?php echo $currentEmail; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Password:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_password" required value="<?php echo $currentPassword; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Address:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_address" required value="<?php echo $currentAddress; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Phone number:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_cellNumber" required value="<?php echo $currentCell; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Position:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_pos" required value="<?php echo $currentPosition; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Information:</label>
                            <div class="col-sm-6">
                            <textarea name="admin_about" class="form-control" rows="3"><?php echo $currentDesc; ?>
                            </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="update" value="Update information" class="btn btn-primary form-control">
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
        $adminName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_name']);

        $adminEmail =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_email']);

        $adminPassword =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_password']);

        $adminId =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_id']);

        $adminAddress = mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_address']);

        $adminCell = mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_cellNumber']);

        $adminInformation =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_about']);

        $adminPosition =  mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_pos']);
         // Validate password strength
         $uppercase = preg_match('@[A-Z]@',  $adminPassword);
         $lowercase = preg_match('@[a-z]@',  $adminPassword);
         $number    = preg_match('@[0-9]@',  $adminPassword);
         $specialChars = preg_match('@[^\w]@', $adminPassword);
         
            
         if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($adminPassword) < 8) {
             echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character')</script>";
             echo "<script>window.history.back();</script>";
             
         }
         else{

        $update_admin = "UPDATE admin set ID='$adminId', Name='$adminName', Email='$adminEmail',Password='$adminPassword',cellNumber='$adminCell',Address='$adminAddress',Position='$adminPosition',About='$adminInformation' where ID='$currentID'";


        
        $executeQ = $dbCon->query($update_admin);

        if($executeQ) {
           

            echo "<script>window.open('index.php?view_admin','_self')</script>";
        }
        else{
            echo "<script>alert('Update failed')</script>";
        }
    }
    }


?>

<?php } ?>