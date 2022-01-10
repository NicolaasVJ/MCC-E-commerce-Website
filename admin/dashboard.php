<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {

    $products = "select * FROM product";
    $Query = $dbCon->query($products);
    $countProducts = mysqli_num_rows($Query);

    $Orders = "select * from orders";
    $Query = $dbCon->query($Orders);
    $OrderNum = mysqli_num_rows($Query);

    $Revenue = 0;
    while($row = mysqli_fetch_array($Query)) {
        if($row['status'] == "Paid") {
            $Revenue += $row['total'];
        }
    }
    $Customers = "select * FROM customer";
    $Query = $dbCon->query($Customers);
    $CustomersCount = mysqli_num_rows($Query);

?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-dark">Dashboard</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card shadow h-100">
                                <div class="card-body bg-warning rounded-top">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                                <h5>PRODUCTS</h5></div>
                                            <div class="h5 mb-0 font-weight-bold text-light"> <?php echo $countProducts; ?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tshirt fa-2x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-bottom">
                                    <span><a href="index.php?view_product" class="text-warning card-link small ">See details</a></span>
                                </div>
                            </div>
                        </div>                       

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="shadow card  h-100">
                                <div class="card-body bg-info rounded-top">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                                <h5>CUSTOMERS</h5></div>
                                            <div class="h5 mb-0 font-weight-bold text-light"> <?php echo $CustomersCount; ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-book fa-2x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-bottom">
                                    <span><a href="index.php?view_customer" class="text-info card-link small ">See details</a></span>
                                </div>
                            </div>
                        </div>                        


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-body bg-primary rounded-top">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                                <h5>ORDERS</h5></div>
                                            <div class="h5 mb-0 font-weight-bold text-light"> <?php echo $OrderNum; ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-bottom">
                                    <span><a href="index.php?view_order" class="card-link small text-primary">See details</a></span>
                                </div>
                            </div>
                        </div>                        

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-body bg-success rounded-top">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                                <h5>REVENUE</h5></div>
                                            <div class="h5 mb-0 font-weight-bold text-light">R <?php echo number_format($Revenue) ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-bottom">
                                    <span><a href="index.php?view_order" class="card-link small text-success">See details</a></span>

                                </div>
                            </div>
                        </div>                         
                </div>                          
<?php } ?>