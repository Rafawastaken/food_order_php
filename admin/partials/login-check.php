<!-- Check if user is logged in -->
<?php
// AUTHORIZATION - Access-Control

if (!isset($_SESSION['user'])) //IF user session is not set
{
  //User is not logged in
  //REdirect to login page with message
  $_SESSION['flash_message'] = array("message" => "You can't view this page", "category" => "danger");
  //REdirect to Login Page
  header('location:' . SITEURL . 'admin/login.php');

  exit();
}
?>