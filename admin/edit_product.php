<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}

else {

    if(isset($_GET['edit_product'])) {
        $ID = $_GET['edit_product'];

        $query = "select * FROM product where productID='$ID'";

        $exec = $dbCon->query($query);

        $Product = mysqli_fetch_array($exec);

        $currentID = $Product['productID'];
        $currentName = $Product['productName'];
        $currentImage = $Product['productImage'];
        $currentPrice = $Product['productPrice'];
        $currentDesc = $Product['productDescription'];
    }

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-edit"></i> Edit Product Information</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product's name:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="product_name" required value="<?php echo $currentName ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product code:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="product_id" required value="<?php echo $currentID ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product Pictures:</label>
                            <div class="col-sm-6">
                            <input type="file" name="product_image" class="form-control-file">
                            <br>
                            <img src="<?php echo "product_images/$currentImage" ?>" width="60" height="60" class="rounded">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Price:</label>
                            <div class="col-sm-6">
                            <input type="number" name="product_price" class="form-control" required value="<?php echo $currentPrice ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product Description:</label>
                            <div class="col-sm-6">
                            <textarea name="product_desc" class="form-control" rows="10"><?php echo $currentDesc ?> 
                            </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="update" value="Update Product" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                    
                    


                </form>
            </div>
        </div>
    </div>
</div>

<?php 

    if(isset($_POST['update'])) {
        
        $productID =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_id']);
        $productName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_name']);
        $productPrice =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_price']);
        $productDescription =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_desc']);
        $productImage = $_FILES['product_image']['name'];
        $temporary = $_FILES['product_image']['tmp_name'];

        if(empty($productImage)) {
            $productImage = $currentImage;
        }

        move_uploaded_file($temporary,"product_images/$productImage");


        $query = "UPDATE product set productID='$productID', productName='$productName',  productDescription='$productDescription', productImage='$productImage',productPrice='$productPrice' where productID='$currentID'";

        $execQ = $dbCon->query($query);

        if($execQ) {
            
            echo "<script>window.open('index.php?view_product','_self')</script>";
        }
        else{
            echo "<script>alert('Product Update Unsucessful')</script>";

        }

    }


?>

<?php } ?>