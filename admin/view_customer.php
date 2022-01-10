<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {

       
        $query = "SELECT * FROM customer";

        $dbResult = $dbCon->query($query);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-address-book"></i> List of customers</div></h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Lock Customer Account</th>
                                    <th>Edit Customer</th>
                                    <th>Delete Customer</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while($res = $dbResult->fetch_assoc()){ 
                                    $beg = "";
                                    $end = "";
                                    if($res['status'] == "LOCKED") {
                                        $beg = "<del>";
                                        $end = "</del>";
                                    }
                                    
                                    ?>
                                   <tr>
                                    <td style="vertical-align: middle;"><?php echo $beg.$res['userID'].$end; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $beg.$res['name'].$end; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $beg.$res['email'].$end; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $beg.$res['cellNumber'].$end; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $beg.$res['address'].$end; ?></td>
                                    <td>
                                    <?php 
                                    
                                    if($res['status'] == "LOCKED") {

                                        echo "<a href='index.php?unlock_customer=".$res['userID']."' class='btn btn-success btn-sm active' role='button' aria-pressed='true'><i class='fas fa-unlock-alt'></i>  Unlock</a>";

                                    }
                                    else {

                                        echo "<a href='index.php?lock_customer=".$res['userID']."' class='btn btn-danger btn-sm active' role='button' aria-pressed='true'><i class='fas fa-lock'></i>  Lock</a>";

                                    }
                                    
                                    ?>
                                    </td>
                                   <td>  
                                       <a href="index.php?edit_customer=<?= $res['userID'] ?>" class="text-primary" style="text-decoration: none">
                                           <i class="fas fa-edit"></i>
                                               EDIT
                                       </a>
                                       
                                   </td>
                                   <td>
                                   <a href="index.php?delete_customer=<?= $res['userID'] ?>" class="text-danger" style="text-decoration: none">
                                           <i class="fas fa-trash-alt"></i>
                                               DELETE
                                       </a>
                                       </td>
                                   </tr>        
                                <?php }?>                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php } ?>