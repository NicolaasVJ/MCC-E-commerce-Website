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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-eye"></i> List of products</div></h6>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product's name</th>
                                <th>Product code</th>
                                <th>Product Pictures</th>
                                <th>Price</th>
                                <th>Delete Products</th>
                                <th>Edit Product Information</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $Query = "select * FROM product";

                            $result = $dbCon->query($Query);

                            while($res = mysqli_fetch_array($result)) {
                                $productName = $res['productName'];
                                $productID = $res['productID'];
                                
                                $productImage = $res['productImage'];
                                $productPrice = $res['productPrice'];
                            
                        ?>
                            <tr>
                                <td> <?php echo $productName ?></td>
                                <td> <?php echo $productID ?> </td>
                                <td><img src="<?php echo "product_images/$productImage" ?>" width="100" height="100" class="rounded shadow"></td>
                                <td>R <?php echo number_format($productPrice); ?></td>
                                <td>
                                    <a href="index.php?delete_product=<?php echo $productID ?>" class="text-danger" style="text-decoration: none">
                                        <i class="fas fa-trash-alt"></i>
                                            DELETE
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?edit_product=<?php echo $productID ?>" style="text-decoration: none">
                                        <i class="fas fa-edit" ></i>
                                            EDIT
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