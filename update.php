<?php
include('connect.php');
if(isset($_GET['update_id'])){
    $id=$_GET['update_id'];
    $sql="select * from products where id = '$id'";
    $result = mysqli_query($connection,$sql);
}

if(isset($_POST['cancel-btn'])){
    header("location:view_products.php");
}
if(isset($_POST['update-btn'])){
    $update_name=$_POST['update_product_name'];
    $update_price=$_POST['update_product_price'];
    $update_image=$_FILES['update_product_image']['name'];
    $update_tmp_image=$_FILES['update_product_image']['tmp_name'];
    $update_image_folder="images/".$update_image;

    $sql="update products set name = '$update_name' , price = '$update_price' , image = '$update_image'
    where id = $id ";
    $result2=mysqli_query($connection,$sql);
    if($result2){
        header("location:view_products.php");
    }
    else{
        echo 'failed to update';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>

    <!-- Css Files -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- include header -->
    <?php include('header.php'); ?>
    <?php
        $row=mysqli_fetch_assoc($result);
    ?>
<div class="container">
    <!-- update Products Card -->
    <div class="update-card">
        <!-- card header -->
        <div class="update-card-header">
            <img class="card-img-top" src="./images/<?php echo $row['image']; ?>" alt="Card image cap">
        </div>
        <!-- card body -->
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Product Name -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i></span>
                    <input type="text" class="form-control" placeholder="Product Name" required autocomplete="off"
                        name="update_product_name" value="<?php echo $row['name'] ?>">
                </div>
                <!-- Product Price -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-coins"></i></span>
                    <input type="number" class="form-control" placeholder="Product Price" required autocomplete="off"
                        name="update_product_price" value="<?php echo $row['price'] ?>">
                </div>
                <!-- Product Image -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                    <input type="file" class="form-control" placeholder="Product file" required autocomplete="off"
                        name="update_product_image" accept="image/jpg image/png image/jpeg">
                </div>
                <!-- Update button -->
                <div class="input-group mt-3">
                    <input type="submit" name="update-btn" class="update-btn btn btn-light" value="Update Product">
                    <input type="reset" name="cancel-btn" class="cancel-btn btn btn-light" value="Cancel" >
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>