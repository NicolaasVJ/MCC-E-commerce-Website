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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-folder-plus"></i> Add Product</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label  text-right col-sm-3 mt-2">Product name:</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 mt-2 text-right">Product code:</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="product_id">
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product Pictures:</label>
                            <div class="col-sm-5">
                            <input type="file" name="product_image" class="form-control-file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Price:</label>
                            <div class="col-sm-5">
                            <input type="number" name="product_price" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Product Description:</label>
                            <div class="col-sm-6">
                            <textarea name="product_desc" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit" value="Add Product" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 

    if(isset($_POST['submit'])) {
        
        $productID =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_id']);
        $productName =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_name']);
        $productPrice =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_price']);
        $productDescription =  mysqli_real_escape_string($dbCon->getConn(),$_POST['product_desc']);

        $productImage = $_FILES['product_image']['name'];
        $tmp_img = $_FILES['product_image']['tmp_name'];


        move_uploaded_file($tmp_img,"product_images/$productImage");


        $Query = "INSERT into product (productID,productName,productDescription,productImage,productPrice) values ('$productID','$productName','$productDescription','$productImage','$productPrice')";

        $exec = $dbCon->query($Query);

        if($exec) {
            
            echo "<script>window.open('index.php?view_product','_self')</script>";
        }
        else
        {
            echo "<script>alert('Add Unsuccessful')</script>";
        }


    }


?>

<?php } ?>