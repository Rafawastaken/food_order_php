<!DOCTYPE html>
<!-- Include constants and user auth -->
<?php
include("../config/constants.php");
include("login-check.php");
?>



<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Food Order - Admin Panel</title>
</head>

<body>
  <!-- Menu section starts -->
  <div class="menu text-center">
    <div class="wrapper">
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./manage-admin.php">Admin Manager</a></li>
        <li><a href="./manage-category.php">Categories</a></li>
        <li><a href="./manage-food.php">Foods</a></li>
        <li><a href="./manage-order.php">Orders</a></li>
        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
  <!-- Menu Section ends -->

  <!-- Flashing messags -->
  <?php include('../common/message.php'); ?>