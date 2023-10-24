<!-- Header -->
<header class="header">
    <div class="header_body">
        <a href="index.php" class="logo">AMA</a>
        <nav class="navbar">
            <a href="index.php">Add Product</a>
            <a href="view_products.php">View Products</a>
            <a href="shopping.php">go shopping</a>

    
    <?php
    include('connect.php');
    $sql="select * from cart";
    $result = mysqli_query($connection,$sql);
    $count = mysqli_num_rows($result);
    ?>
            <!-- Cart icon -->
            <a href="cart.php" class="cart"><i class="fa fa-shopping-cart" ></i><span><sup><?php echo $count ?></sup></span></a>
        </nav>
    </div>
</header> 

