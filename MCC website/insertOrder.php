<?php 
    session_start();
    include("admin/includes/database.php");
    if(isset($_GET['submit'])) {
        $dbCon = new dbConnect();
        $getTotal = $_SESSION['cart'];
        $cart = $getTotal;
        $userID = $_SESSION['user_id'];
        $DeliveryFee=100;
        //Calculate total
        $total = 0;
        foreach($getTotal as $product) {
            $total += (int)$product["price"]*$product["quantity"];
        }
        $total=$total+$DeliveryFee;
        //random order id
       
        $RandomID = rand();

        $orderID = (int)$RandomID;

        $user = (int)$userID;
       
        
  
       $insertOrder = "INSERT INTO orders(orderID, userID, total, status) VALUES ($orderID,$user,$total,'Unpaid')";//INVOICE
      

       $executeInsert = $dbCon->query($insertOrder);
       
//c_Order
if($executeInsert) { 

    $executeC;

    foreach($cart as $value) {
        
        $productID = array_search($value,$cart);

        $quantity = $value["quantity"];
        
        $subTotal = (int)$value["price"]*$quantity;
        
        $queryC = "INSERT INTO c_order (orderID, productID, quantity, subtotal) VALUES ($orderID,'$productID', $quantity, $subTotal)";

        
        $executeC = $dbCon->query($queryC);
        
    }
          
            if($executeC) {

                unset($_SESSION['cart']);

                echo "<script>window.open('index.php','_self')</script>";

            }
            else{
                echo "<script>alert('Unsuccessful Order creation')</script>";
            }

        }

    }

?>