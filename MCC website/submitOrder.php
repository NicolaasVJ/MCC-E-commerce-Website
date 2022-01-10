<?php

session_start();

include("admin/includes/database.php");
if(!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    echo "<script>window.open('cart.php','_self')</script>";
}
else 
$userID = $_SESSION['user_id'];
$query = "SELECT address FROM customer WHERE userID = '$userID'";

$dbCon = new dbConnect();

$result = $dbCon->query($query);

$row = mysqli_fetch_array($result);

$Address = $row['address'];
$DeliveryFee=100;


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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbarColor01">
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
            if(!isset($_SESSION['user_email'])) {

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
                        <a href="" class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link border-right">Cart</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link border-right">Delivery</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link border-right">Payment</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-primary text-light nav-link disabled active font-weight-bold rounded-1 nav-link border-right">Order confirmation</a>
                    </li>
                </ul>
            </div>


            <div class="my-5 d-block">
                
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border-bottom py-3">
                                <h5><i class="fas fa-map-marked"></i> Delivery address</h5>
                                <p class="text-muted"><?php echo $Address; ?></p>
                            </div>
                            <div class="border-bottom py-3">
                                <h5><i class="fas fa-file-invoice-dollar"></i> Payment method</h5>
                                <p class="text-muted">EFT</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border bg-light mt-5 mt-lg-12">
                                <h5 class="text-center border-bottom p-3">
                                    Overview
                                </h5>
                                <?php 
                                    $cartItems = $_SESSION['cart'];
                                    $total = 0;
                                    foreach($cartItems as $product) {
                                        $total = $total + (int)$product["price"]*$product["quantity"];
                                    }
                                ?>
                                <div class="d-flex justify-content-between px-3 py-2">
                                    <div>Combined Item Price</div>
                                    <h5>R <?php echo number_format($total); ?></h5>
                                </div>
                                <div class="d-flex justify-content-between px-3 py-2">
                                    <div>Delivery Fee</div>
                                    <h5>R <?php echo number_format($DeliveryFee); ?></h5>
                                </div>

                                <div class="d-flex justify-content-between p-3 border-top font-weight-bold">
                                    <div>Total</div>
                                    <h5>R <?php echo number_format($total+$DeliveryFee); ?></h5>
                                </div>
                                <form method="GET" action="insertOrder.php">
                                    <button type="submit" name="submit" class="btn btn-block btn-info btn-lg font-weight-bold mb-n4">Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
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

    <?php include("login_signup_modal.php"); ?>
    <script type="text/javascript" src="js/cart_process.js"></script>
 
</body>
</html>