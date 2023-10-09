<?php
include('connect.php');

if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
    
    $delete_query="delete from products where id = '$id' ";
    $result = mysqli_query($connection,$delete_query) or die("failed to delete");
    if($result){
        header("location:view_products.php");
    }

}

?>