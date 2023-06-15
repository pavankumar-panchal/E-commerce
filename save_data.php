<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'con.php';

if (isset($_GET["action"])) {
  if ($_GET["action"] == 'save') {
    $customer_id = $_POST["customer_id"];
    $customer_id = filter_var($customer_id, FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['customer_id'] = $customer_id;

    $customer_name = $_POST["customer_name"];
    $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);
    $_SESSION['customer_name'] = $customer_name;

    $address = $_POST["address"];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $_SESSION['address'] = $address;

    $mobile_number = $_POST["mobile_number"];
    $mobile_number = filter_var($mobile_number, FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['mobile_number'] = $mobile_number;

    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $_SESSION['email'] = $email;

    $contact_person = $_POST["contact_person"];
    $contact_person = filter_var($contact_person, FILTER_SANITIZE_STRING);
    $_SESSION['contact_person'] = $contact_person;

    setcookie('mobile_number', $mobile_number, time() + (86400 * 30), '/');
    setcookie('customer_name', $customer_name, time() + (86400 * 30), '/');

    if (empty($_SESSION['customer_name'])) {
      $error_message = "Please enter the customer name.";
    } elseif (empty($_SESSION['address'])) {
      $error_message = "Please enter the address.";
    } elseif (empty($_SESSION['mobile_number'])) {
      $error_message = "Please enter the mobile number.";
    } elseif (empty($_SESSION['email'])) {
      $error_message = "Please enter your email.";
    } elseif (empty($_SESSION['contact_person'])) {
      $error_message = "Please enter the contact person name.";
    } else {
      $_SESSION['customer_name'] = mysqli_real_escape_string($con, $_SESSION['customer_name']); // escapes special characters in a string 
      $_SESSION['address'] = mysqli_real_escape_string($con, $_SESSION['address']);
      $_SESSION['mobile_number'] = mysqli_real_escape_string($con, $_SESSION['mobile_number']);
      $_SESSION['email'] = mysqli_real_escape_string($con, $_SESSION['email']);
      $_SESSION['contact_person'] = mysqli_real_escape_string($con, $_SESSION['contact_person']);

      if ($_SESSION['customer_id']) {
        $query = "UPDATE Customers SET customer_name = '$_SESSION[customer_name]', address = '$_SESSION[address]', mobile_number = '$_SESSION[mobile_number]', 
        email = '$_SESSION[email]', contact_person = '$_SESSION[contact_person]' WHERE customer_id = '$_SESSION[customer_id]'";
      } else {
        $query = "INSERT IGNORE INTO Customers (customer_name, address, mobile_number, email, contact_person) 
        VALUES ('$_SESSION[customer_name]','$_SESSION[address]','$_SESSION[mobile_number]','$_SESSION[email]','$_SESSION[contact_person]')";
      }

      $result = mysqli_query($con, $query);

      if ($result) {
        header("location: ind.php");
        exit;
      } else {
        $error_message = "Error occurred. Please try again.";
      }
    }

  } elseif ($_GET["action"] == 'del') {
    try {

      $_SESSION['customer_id'] = $_GET["customer_id"];
      mysqli_query($con, "DELETE FROM Customers WHERE customer_id = '$_SESSION[customer_id]'");
      header("location: ind.php");
      exit;
    } catch (Exception $e) {

      if (isset($e)) {
        header("Location: ind.php?error=" . urlencode($e));
        exit();
      }
    }
  }
}
if (isset($error_message)) {
  header("Location: ind.php?error=" . urlencode($error_message));
  exit();
}


?>