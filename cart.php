<?php
include('connect.php');
include('header.php');

$sql = "select * from cart";
$result = mysqli_query($connection,$sql);

if(isset($_POST['continue-shopping'])){
    header('location:shopping.php');
}

if(isset($_POST['increase-btn'])){
    $idd=$_POST['id'];
    echo $idd;
    $quantity=$_POST['quantity'];
    $quantity++;
    echo $quantity;
    $sql="update cart set quantity = $quantity where id = '$idd'";
    mysqli_query($connection,$sql) or die("failed to update quantity");
}
if(isset($_POST['decrease-btn'])){
    $idd=$_POST['id'];
    echo $idd;
    $quantity=$_POST['quantity'];
    $quantity--;
    echo $quantity;
    $sql="update cart set quantity = $quantity where id = '$idd'";
    mysqli_query($connection,$sql) or die("failed to update quantity");
}
if(isset($_GET['delete_id'])){
    $delete=$_GET['delete_id'];

    $delete_query="delete from cart where id = '$delete' ";
    $result = mysqli_query($connection,$delete_query) or die("failed to delete");
    if($result){
        header("location:cart.php");
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Css Files -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



    <div class="container">
        <div class="cart">
        <?php

            if(mysqli_num_rows($result)>0){

        ?>
            <h1>MY CART</h1>
            <table>
                <thead>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <?php
                $checkout=0;
                $no=0;
                    while($row=mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                    <tr>
                        <td><?php echo ++$no ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo number_format($row['price'])?></td>
                        <td><img src="./images/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>"></td>
                        <form action="" method="post">
                            <td>
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="quantity" value="<?php echo $row['quantity'] ?>">
                                <input type="submit" value="-" name="decrease-btn">
                                <span><?php echo $row['quantity'] ?></span>
                                <input type="submit" value="+" name="increase-btn">
                            </td>
                        </form>
                        <!-- <td><i class="fa fa-minus"></i> <i class="fa fa-plus"></i></td> -->
                        <td><?php echo $total_price = $row['quantity']*$row['price'] ?></td>
                        <td><a href="cart.php? delete_id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this products?');"><i class="fas fa-trash"></i></a></td>
                        <?php $checkout+= $total_price?>
                        
                    </tr>
                </tbody>
                <?php
                    }
                    ?>
            </table> 
            <div class="table-bottom">
                <a href="shopping.php">Continue shopping</a>
                <h4>Grand Total: $<span><?php echo $checkout?></span>/-</h4>
                <a href="checkout.php">Proceed to Checkout</a>
            </div>
            <?php
                
            }else{
                echo"<div class='no_products'>
                    Cart is Empty
                </div>";
            }
            
            ?>
        </div>
    </div>
    
</body>
</html>