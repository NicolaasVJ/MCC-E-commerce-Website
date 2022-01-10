<?php

session_start();

include("admin/includes/database.php");

$userLogIn = "";
$href = "#";
$userStatus = "";
if(!isset($_SESSION['user_id'])) {
    $userLogIn = "data-toggle='modal' data-target='#loginModal'";

   
}
else {

    $userid = $_SESSION['user_id'];
    $userStatusQuery = "SELECT status FROM customer WHERE userID='$userid'";

    $dbConnectopn = new dbConnect();
    $result = $dbConnectopn->query($userStatusQuery);
    $row = mysqli_fetch_array($result);

    if($row['status'] == "LOCKED") {
        $userStatus = "onclick= AccountLockNotification()";
    }
    else {
        $href = "shipping.php";

    }
     
}


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
      .btn:focus {
  box-shadow: none;
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
                    $itemTotal = 0;
                    $total_itemQuantity = 0;
                    if(isset($_SESSION['cart'])) {
                        foreach($_SESSION['cart'] as $value) {
                           $total_itemQuantity += $value["quantity"]; 
                           $itemTotal += (int)$value["price"]*$value["quantity"];
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
                        <a href="" class="m-0 px-0 py-2 bg-primary text-light nav-link disabled active font-weight-bold rounded-1 nav-link border-right">Cart</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link border-right">Delivery</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link border-right">Payment</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-2 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-1 nav-link">Order confirmation</a>
                    </li>
                </ul>
            </div>


            <div class="my-5">
                <div class="row col-md-12">
                    <div class="col-12 mb-4 px-0">
                    <?php 
                        
                        if(isset($_SESSION['cart'])) {
                            $cartTotal = 0;
                            $cartItems = $_SESSION['cart'];
                    ?>
                        <table class="w-100 table table-bordered text-center">
                            <thead>
                                <th></th>
                                <th>Item</th>
                                <th>Item Price</th>
                                <th>Quantity</th>
                                <th>Sub-Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($cartItems as $product) {
                            ?>
                                <tr class="font-weight-bold">
                                    <td><img src="<?php echo "admin/product_images/".$product["image"] ?>" style="width: 50px; height: auto;"></td>
                                    <td class="align-middle"><?php echo $product["name"]; ?></td>
                                    <td class="align-middle">R <?php echo number_format($product["price"]); ?></td>
                                    <input type="hidden" class="iprice" value="<?php echo number_format($product["price"]); ?>">
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center text-center">
                                        <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-dec">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text"  class="text-center justify-content-center border border-left-0 border-right-0 iquantity" style="width: 1.5em" value="<?php echo $product["quantity"]; ?>" readonly>
                                        <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-inc">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">R <span class="itotal"><?php $cartTotal += $product["price"]*$product["quantity"];echo number_format($product["price"]*$product["quantity"]); ?></span></td>
                                    <td class="align-middle"><button class="btn btn-outline-danger" onclick="removeItem('<?php echo array_search($product,$cartItems); ?>')"><i class="fas fa-trash-alt"></i></button></td>
                                    <input type="hidden" class="pID" value="<?php echo array_search($product,$cartItems); ?>">
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>

                        <div class="mt-5 ml-auto col-lg-5 px-0 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center w-100 p-3">
                                <h4 class="mb-0 text-dark">Item Total: </h4>
                                <h4 class="mb-0 text-dark">R <span id="total"><?php echo number_format($cartTotal); ?></span></h4>
                            </div>
                            <div class="px-3 mb-5">
                                <a href="<?php echo $href; ?>" class="btn btn-info btn-block btn-lg py-3" <?php echo $userLogIn; ?> <?php echo $userStatus; ?>>Confirm</a>
                            </div>
                        </div>
                    <?php 
                        } else {

                    ?>
                    <div class="text-center py-5 font-weight-bolder">
                            <p>Your Cart is empty, lets change that!</p>
                            <a href="product.php" class="btn btn-info mt-2">Back to Product Page</a>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
    </div>
    <body class="d-flex flex-column min-vh-100">
    <div class="wrapper flex-grow-1"></div>
    <footer class="bg-dark">
        <div class="container-fuild text-light">
            <div class="row card-deck pt-3 ml-0">
                <div class="col-md-0 pr-0">
                    <div class="card border-0 bg-dark ml-0">
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