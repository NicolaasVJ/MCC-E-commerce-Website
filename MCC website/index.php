<?php

session_start();

include("admin/includes/database.php");
$dbCon = new dbConnect();


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="img/favicon.ico" />
  <title>Meágan's Creative Corner</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/cart_process.js"></script>

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
        font-size: 14px;
        border-radius: 50%;
        border-width: 2px;
        min-height: 18px;
        min-width: 18px;
        right: -10px;
        top: -13px;
        
    }
    .p:hover {
    box-shadow: 0 0 11px rgba(255,180,255,.8); 
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
            if(!isset($_SESSION['user_email'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("navbar.php");
            }
            ?>
            <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
            <div class="toast bg-success font-weight-bold p-2 text-light">
                <div class="toast-body">
                    ITEM ADDED TO CART
                </div>
            </div>
    </div>
          </form>
        </div>        
    </nav>
    

    <div class="jumbotron py-2" style="background-color: #bd00ad;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="font-weight-bold" style="color: #a9; text-shadow: 4px 4px #2e2e2e;">
                       
                        <span style="color: #fbb419;font-size:125%">GET YOUR OWN PRINT</span>
						 
                    </h2>
                    <h1 class="font-weight-bold" style="color: #000000;  text-shadow: 3px 3px #fbb419; font-size: 550%;">
                        <span>TODAY</span><br>
                    </h1>
                </div>
                <div class="col-md-4">
                    <img src="img/duck.png" style=" height: auto" class="text-right w-50 d-block m-auto">
                </div>
            </div>
            
        </div>
    </div>

    <div class="container-fluid hpproduct text-center">
        <div class="row mt-4 mb-4">
            <div class="col-md-12 ">
                <h2 class="font-weight-bolder" style="color: #2f3640;text-decoration:overline">ARTS AVAILABLE FOR PRINT</h2>
                <div class="row mt-0 mx-0 ">
                <?php 

                    $i = 0;
                   
                    $qProducts = "SELECT * FROM product ORDER BY RAND() LIMIT 4";//Picked by RANDOM
                    $resultProducts = $dbCon->query($qProducts);



                    while($gProduct = mysqli_fetch_array($resultProducts)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $gProduct['productID'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo "admin/product_images/".$gProduct['productImage'] ?>" class="card-img-top h-100 img-reponsive">
                                </a>
                                </div> 
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $gProduct['productID'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $gProduct['productName'] ?></h6>
                                        <div class="font-weight-bold text-danger">R<?php echo number_format($gProduct['productPrice']); ?></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $gProduct['productID'] ?>')" class="btn w-100 mt-auto"><i class="fas fa-cart-plus"></i> Add to Cart</button>

                                </div>
                                
                            </div> 
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
    
</body>
</html>