<!-- Connecting to Database -->
<?php include('connect.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>

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
        <table class="display_products">
            <?php
                $sql="select * from products";
                $result=mysqli_query($connection,$sql);
                $num=1;
                if(mysqli_num_rows($result)>0){
                    echo "<thead >
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Action</th>
                </thead>";
                    while($row=mysqli_fetch_assoc($result)){
                        
                        
            ?>
                
                <tbody>
                <tr>
                    <td><?php echo $num++ ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><img src="images/<?php echo $row['image'] ?>" alt=<?php echo $row['name'] ?> width="100" height="100"></td>
                    <td>
                        <a href="delete.php? table=products delete_id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this products?');"><i class="fas fa-trash"></i></a>
                        <a href="update.php? update_id=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>

                <?php
                    }
                }else{
                    echo"<div class='no_products'>
                    No Products to display
                </div>";
                }
                ?>
                
            </tbody>
        </table>
</div>

</body>
</html>