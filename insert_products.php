<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "con.php";
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_type = $_POST['product_type'];
$product_item = $_POST['product_item'];
$rate = $_POST['rate'];

$product_type = ($product_type) ? $_POST['product_type'] : "Item";

if ($product_id) {
    $query = "UPDATE products SET  product_name = '$product_name', product_type = '$product_type', rate = '$rate', product_item =' $product_item' WHERE product_id = '$product_id'";
} else {
    $query = "INSERT INTO products (product_name, product_type, rate, product_item) VALUES ('$product_name', '$product_type', '$rate', '$product_item')";
}

$result = mysqli_query($con, $query);

if ($result) {
    header("location: add.php");
    exit;
} else {
    $error_message = "Error occurred. Please try again.";
}
?>