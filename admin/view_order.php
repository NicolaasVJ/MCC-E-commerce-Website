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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list"></i> Orders</div></h6>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order Placed at</th>
                                <th>Customer Name</th>
                                <th>OrderID</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>View Order Details</th>
                                <th>Delete Order</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $OrderQuery = "SELECT name, orders.orderID, orders.status, total, orderTime FROM orders, customer WHERE customer.userID = orders.userID ORDER BY orderTime DESC";
                                $result = $dbCon->query($OrderQuery);
                                while($res = mysqli_fetch_array($result)) {
                                    $orderTime = $res['orderTime'];
                                    $username = $res['name'];
                                    $orderID = $res['orderID'];
                                    $status = $res['status'];  
                                    $total = $res['total'];   
                                    
                            ?>
                            <tr>
                            <td> <?php echo $orderTime ?> </td>
                                <td> <?php echo $username ?> </td>
                                <td> <?php echo $orderID ?> </td>
                                <td>R<?php echo number_format($total)?></td>
                                <td> <?php echo $status ?></td>
                                <td>
                                    <a href="index.php?view_order_detail=<?php echo $orderID ?>" style="text-decoration: none">
                                        <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                </td>
                                <td>
                                    <a href="index.php?delete_order=<?php echo $orderID ?>" class="text-danger" style="text-decoration: none">
                                        <i class="fas fa-trash-alt"></i>
                                            Delete
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