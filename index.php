<?php
include('connect.php');

// Inserting Data into DataBase
if(isset($_POST['submit-btn'])){
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_FILES['product_image']['name'];
    $product_image_tmp_name=$_FILES['product_image']['tmp_name'];
    $product_image_folder='images/'.$product_image;
    


    $insert_query="insert into products (name,price,image) values 
    ('$product_name','$product_price','$product_image')";
    $result=mysqli_query($connection,$insert_query) or die('failed to insert');
    
    if($result){
        move_uploaded_file($product_image_tmp_name,$product_image_folder);
        $display_message="Product inserted successfully";
    }else{
        $display_message="Failed to insert the product";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <!-- Css Files -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- include header -->
<?php include('header.php'); ?>


    <div class="container">

    <!-- Message display -->
    <?php
    if(isset($display_message)){
        echo "<div class='display-message'>
        <span>$display_message</span>
        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'; ></i>
    </div>";
    }
    ?>

<!-- Add Products Card -->
        <div class="card">
            <!-- card header -->
            <div class="card-header">
                <h3 class="text-center">Add Product</h3>
            </div>
            <!-- card body -->
            <div class="card-body">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i></span>
                        <input type="text" class="form-control" placeholder="Product Name" required autocomplete="off"
                            name="product_name">
                    </div>
                    <!-- Product Price -->
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-coins"></i></span>
                        <input type="number" class="form-control" placeholder="Product Price" required autocomplete="off"
                            name="product_price">
                    </div>
                    <!-- Product Image -->
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                        <input type="file" class="form-control" placeholder="Product file" required autocomplete="off"
                            name="product_image" accept="image/jpg image/png image/jpeg">
                    </div>
                    <!-- Submit button -->
                    <div class="input-group mt-3">
                        <input type="submit" name="submit-btn" class="add-btn btn btn-light w-100" value="Add Product">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script></script>
</body>
</html>