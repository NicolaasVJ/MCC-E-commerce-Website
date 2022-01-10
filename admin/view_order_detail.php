<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {
    if(isset($_GET['view_order_detail'])) {

     $orderID = $_GET['view_order_detail'];

    $QueryC = $dbCon->query("SELECT name, email,cellNumber, address, orders.status FROM customer,orders WHERE customer.userID = orders.userID AND orders.orderID = ' $orderID'");

    $resultC = mysqli_fetch_array($QueryC);
    $QueryC->close();

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-eye"></i> Invoice Details <?=  $orderID ?></div></h6>
            <div class="card-body">

                <div class="row ml-2 mr-2 mb-1">
                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-body">
                            <br>
                            <span>Customer name: <?php echo $resultC['name'] ?></span><br><br>
                            <span>Email: <?php echo $resultC['email'] ?></span><br><br>
                            <span>Cell number: <?php echo $resultC['cellNumber'] ?> </span><br><br>
                            <span>Address: <?php echo $resultC['address'] ?></span><br><br>
                            <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-2 mt-2"></label>
                            <div class="col-12">
                            <span>Payment status: <?php echo $resultC['status'] ?></span><br><br>

                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="submit" name="update" value="Change Payment Status" class="btn btn-primary form-control">
                            </form>
                            </div>
                        </div>
                    </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Picture</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                
                                $dbCon->setNextRs();
                                $Query = $dbCon->query("SELECT productName, product.productID, productImage, quantity, subtotal FROM product, c_order WHERE c_order.productID = product.productID AND c_order.orderID = ' $orderID'");
                            
                                while ($res = mysqli_fetch_array($Query)) {

                            ?>
                           <tr>
                                <td> <?php echo $res['productName'] ?> </td>
                                <td> <?php echo $res['productID'] ?> </td>
                                <td> <img src="<?php echo "product_images/".$res['productImage'] ?>" width="100" height="100" class="rounded"> </td>
                                <td> <?php echo $res['quantity'] ?> </td>
                                <td>R <?php echo number_format($res['subtotal'])?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

if(isset($_POST['update'])) {
    
    $queryStatus = $dbCon->query("SELECT status FROM orders WHERE orderID = ' $orderID'");

        $res = mysqli_fetch_array($queryStatus);

        $status=$res['status'];

        $queryStatus->close();
        

        if($status=="Unpaid"){
  
          $status = "Paid";
        }
        else{
          $status = "Unpaid" ;
        };
   
             // $orderID
                $update_status = "UPDATE `orders` SET `status` = '$status' WHERE `orders`.`orderID` = $orderID";
                 
                 $executeQ = $dbCon->query($update_status);
             
                 if($executeQ) {
                    
                     echo "<script>window.open('index.php?view_order','_self')</script>";
                 }
                 else{
                     echo "<script>alert('Update failed')</script>";
                 }
              
       
    }
?>
<?php }} ?>