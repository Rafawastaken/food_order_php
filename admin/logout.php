<?php
// Include constants
include('../config/constants.php');

// Unset the user session variable to log the user out
unset($_SESSION['user']);

// Set the flash message to indicate successful logout
$_SESSION['flash_message'] = array("category" => "success", "message" => "You've been logged out");

// Redirect to the login page
header("location:" . SITEURL . 'admin/login.php');
