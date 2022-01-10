<?php

session_start();

include("admin/includes/database.php");

$dbCon = new dbConnect();
$userID = $_SESSION['user_id'];
$orderID = $_GET['orderID'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="img/favicon.ico" />
  <title>Meágan's Creative Corner</title>
  <meta charset="utf-8">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
      .nav-link:hover {
        color: #FF00FF !important;
        font-weight: bold;
      }
      .nav-link {
          color:white !important;
      }
      .cart-amount {
        top: -13px;
        right: -10px;
        min-width: 20px;
        min-height: 20px;
        border-width: 2px;
        border-radius: 50%;
        font-size: 12px;
    }
   
    
    

  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient bg-dark sticky-top shadow-lg py-2">
        <div class="container">
            <a class="navbar-brand" href="index.php"></span class="sr-only">Meágan's <span style="color: #FF00FF ;font-weight: bold">Creative </span class="sr-only">Corner</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbar1">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home page <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="product.php">Products</a>
            </li>
          </ul>
          <form class="form-inline">
            <a href="cart.php" class="btn my-sm-0 border-0 bg-transparent text-light">
                <i class="fas fa-shopping-cart position-relative">
               
                <?php
                    
                    $total_itemQuantity = 0;
                    if(isset($_SESSION['cart'])) {
                        foreach($_SESSION['cart'] as $value) {
                           $total_itemQuantity += $value["quantity"]; 
                        } 
                    }
                ?>
                <div class="cart-amount bg-info position-absolute text-white d-flex justify-content-center align-items-center font-weight-bold">
                <span id="cart_amount"><?php echo $total_itemQuantity ?></span>
                </div></i>
            </a>
            <?php
            if(!isset($_SESSION['user_id'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("navbar.php");
            }
            ?>
          </form>
        </div>        
    </nav>

    
    <div class="container pb-5 position-relative pt-2">
            <div class="mt-5 d-block ">
                <ul class="nav nav-pills nav-fill border-0 rounded-0">
                    <li class="flex-grow-1 text-center nav-item">
                    <div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list"></i> Order #<?php echo $orderID?></div></h6>
            <div class="card-body ">
                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                               <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Picture</th>
                                <th>Quantity</th>
                                <th>Cost per Item</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                
                                $dbCon->setNextRs();
                                $getDetailOrder = $dbCon->query("SELECT `product`.`productName`, `orders`.`total`, `product`.`productID`, `product`.`productImage`, `c_order`.`quantity`, `c_order`.`subtotal`, `orders`.`total`
                                FROM `product`
                                , `orders` 
                                LEFT JOIN `c_order` ON `c_order`.`orderID` = `orders`.`orderID`WHERE c_order.productID = product.productID AND c_order.orderID = ' $orderID';");
                               
                                $orderTotal= 0;
                                
                                while ($row = mysqli_fetch_array($getDetailOrder)) {
                                        $pPerItem=($row['subtotal']/$row['quantity']);
                                        $orderTotal= $orderTotal+$row['subtotal'];
                                        $finalTotal=$row['total'];
                                        $deliveryFee=$finalTotal-$orderTotal;//Will hold true even if delivery cost changes
                                        
                            ?>
                           <tr>
                                <td class="align-middle"> <?php echo $row['productName'] ?> </td>
                                <td class="align-middle"> <?php echo $row['productID'] ?> </td>
                                <td class="align-middle"> <img src="<?php echo "admin/product_images/".$row['productImage'] ?>" width="100" height="100" class="rounded"> </td>
                                <td class="align-middle"> <?php echo $row['quantity'] ?> </td>
                                <td class="align-middle">R <span ><?php echo $pPerItem; ?></span></td>
                                <td class="align-middle">R <?php echo number_format($row['subtotal'])?></td>
                               
                                <?php } ?>         
                            </tr>
                            <table class="table table-borderless">
                            <thead>
                            <tr>
                            <td ></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-decoration:underline"class="font-weight-bold">Item Order Total</td>
                            <td class="font-weight-bold "><div>R <?php echo number_format($orderTotal); ?></td>
                            </tr>
                            <tr>
                            <td ></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-decoration:underline"class="font-weight-bold">Delivery Fee</td>
                            <td class="font-weight-bold">R <?php echo number_format($deliveryFee); ?></td>
                            </tr>
                            <tr>
                            <td ></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-decoration:underline"class="font-weight-bold">Total</td>
                            <td class="align-start font-weight-bold">R <?php echo number_format($finalTotal); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </li>
                      
            </div>

            



    </div>
    <body class="d-flex flex-column min-vh-100">
    <div class="wrapper flex-grow-1"></div>
    <footer class="bg-dark">
        <div class="container-fuild text-light">
            <div class="row card-deck pt-3 ml-6">
                <div class="col-md-5 pr-0">
                    <div class="card border-0 bg-dark ml-5">
                        <div class="card-header bg-dark border-0"><h4>Meágan's Creative Corner</h4></div>
                        <div class="card-body border-0">
                            <p>I Hope you are having a wonderful day.</p>   
                            <p>May Happiness find you.</p>
                            <p>You are loved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md pl-0">
                    <div class="card border-0 bg-dark">
                    </div> 
                <div class="col-md">
                    <div class="card border-0 bg-dark mx-0">
                        <div class="card-header bg-dark border-0"><h4>Contact us</h4></div>
                        <div class="card-body border-0">
                            <p><i class="fas fa-envelope-open-text mr-2"></i> meagensccorner@gmail.com</p>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
        
        <div class="container-fluid text-center text-light p-1">
            <h7>Copyright ©<script>document.write(new Date().getFullYear())</script>.</h7>
        </div>
    </footer>
    </body>
    <?php 
    

?>


    <?php  include("login_signup_modal.php");
        ?>
    
</body>
</html>