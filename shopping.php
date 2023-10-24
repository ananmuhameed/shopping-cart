<?php
include('connect.php');
include('header.php');


    $sql="select * from products";
    $result1 = mysqli_query($connection,$sql);

    if(isset($_POST['add-cart'])){
        $id = $_POST['product-id'];
        $sql="select * from products where id = '$id'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);
        
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $quantity = 1;

        // quantity
        $sql = "select * from cart where name = '$name'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
            $display_message = "Product already added";
            $alert_type = "alert-success";
        }
        else{
            $display_message = "Product added Successfully";
            $alert_type = "alert-warning";
            $sql="insert into cart (name,price,image,quantity)
            values('$name','$price','$image',$quantity)";
            $insert_cart_result = mysqli_query($connection,$sql) or die("failed to add to cart");
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>go Shopping</title>

    <!-- Css Files -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
    

        <div class="products">
            <h1>Let's Shop</h1>
            <?php
            if(mysqli_num_rows($result1)>0){
                while($row=mysqli_fetch_assoc($result1)){

            ?>  
                <div class="product">
                    <form action="" method="post">
                        <div class="product-header">
                            <img src="./images/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
                        </div>
                        <h3><?php echo $row['name'] ?></h3>
                        <div class="price">price: $<?php echo $row['price'] ?>/-</div>
                        <input type="hidden" name="product-id" value="<?php echo $row['id'] ?>">
                        <input type="submit" value="Add to cart" class="cart-btn" name="add-cart">
                    </form>
                </div>
            <?php
                }
            }
            else{
                echo"<div class='no_products'>
                No Products to display
                </div>";
            }    
            ?>
    
        </div>
    </div>
</body>
</html>