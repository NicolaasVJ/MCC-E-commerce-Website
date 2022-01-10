<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-eye"></i> List of Admin</div></h6>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Position</th>
                                <th>Delete Admin</th>
                                <th>Edit Administrator Information</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $Query = "select * from admin";

                        $result = $dbCon->query($Query);

                        while($res = mysqli_fetch_array($result)) {
                            $adminID = $res['ID'];
                            $adminName = $res['Name'];
                            $adminEmail = $res['Email'];
                            $adminCell = $res['cellNumber'];
                            $adminAddress = $res['Address'];
                            $adminPosition = $res['Position'];

                        ?>


                        
                            <tr>
                                <td> <?php echo $adminID ?> </td>
                                <td> <?php echo $adminName ?> </td>
                                <td> <?php echo $adminEmail ?> </td>
                                <td> <?php echo $adminCell ?> </td>
                                <td> <?php echo $adminAddress ?> </td>
                                <td> <?php echo $adminPosition ?> </td>
                                <td>
                                    <a href="index.php?delete_admin=<?php echo $adminID ?>" class="text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                            DELETE
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?edit_admin=<?php echo $adminID ?>">
                                        <i class="fas fa-edit" ></i>
                                            EDIT
                                        </a>
                                </td>
                            </tr>

                            <?php } ?>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>