<?php
    session_start();

    include("admin/includes/database.php");

    if(isset($_POST['productID'])) {
        
        $productId = $_POST['productID'];

        $dbCon = new dbConnect();

        $getProduct = $dbCon->query("SELECT * FROM product WHERE productID='$productId'");

        $dbResult = mysqli_fetch_array($getProduct);

        if(!isset($_SESSION['cart'])) {
            $itemCart[$productId] = array(
                "name" => $dbResult['productName'],
                "image" => $dbResult['productImage'],
                "price" => $dbResult['productPrice'],
                "quantity" => 1
            );

        } else {
            $itemCart = $_SESSION['cart'];
            if(array_key_exists($productId,$itemCart)) {
                $quantity = $itemCart[$productId]["quantity"] + 1;
                $itemCart[$productId] = array(
                "name" => $dbResult['productName'],
                "image" => $dbResult['productImage'],
                "price" => $dbResult['productPrice'],
                    "quantity" => $quantity
                );
            } else {
                $itemCart[$productId] = array(
                    "name" => $dbResult['productName'],
                    "image" => $dbResult['productImage'],
                    "price" => $dbResult['productPrice'],
                    "quantity" => 1
                );
            }
        }

        $_SESSION['cart'] = $itemCart;

            $total_price = 0;
            $total_itemQuantity = 0;
                foreach($_SESSION['cart'] as $value) {
                   $total_itemQuantity += $value["quantity"];
                  $total_price += (int)$value["price"]*$value["quantity"];
        }

        echo  $total_itemQuantity."-".$total_price;
    }

    if(isset($_POST['removeID'])) {
        $getProductID = $_POST['removeID'];
        $itemCart = $_SESSION['cart'];

        unset($itemCart[$getProductID]);

        if(count($itemCart) == 0) {
            unset($_SESSION['cart']);
        } else {
            $_SESSION['cart'] = $itemCart;
        }

    }
    if(isset($_POST['updateID']) && isset($_POST['quantity'])) {
        $updateID = $_POST['updateID'];
        $quantity = $_POST['quantity'];

        $itemCart = $_SESSION['cart'];
        $itemCart[$updateID]["quantity"] = $quantity;

        $_SESSION['cart'] = $itemCart;

        $result_quantity = 0;
        foreach($itemCart as $value) {
            $result_quantity += $value["quantity"];  
        }

        echo $result_quantity;
    }

?>
