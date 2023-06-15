<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'con.php';
session_start();

try {
    if (isset($_GET["action"])) {
        if ($_GET["action"] == 'del') {
            $product_id = $_GET["product_id"];
            $query = "DELETE FROM products WHERE product_id = '$product_id'";
            $result = mysqli_query($con, $query);
            if ($result) {
                header("Location: add.php");
                exit();
            } else {
                echo "We can't delete   <script> alert('can't delete ');";
            }
        }
    }
} catch (Exception $e) {
    if (isset($e)) {
        header("Location: add.php?error=" . urlencode($e));
        exit();
    }
}
?>