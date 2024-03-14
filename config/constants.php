<?php
// start session
session_start();

// Create constants
define("SITEURL", "http://localhost/food_order/");

// Database constants
define("LOCALHOST", "localhost");
define("DB_USERNAME", "root");
define('DB_PASSWORD', "");
define('DB_NAME', "food-order");

// Default phpmyadmin: root and no password
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));

// Select database
$db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error($conn));
