<?php

//AUthorization - Access COntrol
//CHeck whether the user is logged in or not
if (!isset($_SESSION['user'])) //IF user session is not set
{
  //User is not logged in
  //REdirect to login page with message
  $_SESSION['flash_message'] = array("message" => "Please, login first.", "category" => "danger");

  //REdirect to Login Page
  header('location:' . SITEURL . 'admin/login.php');

  exit();
}
