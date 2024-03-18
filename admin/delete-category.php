<?php
// Import constans folder
include('../config/constants.php');
include('../common/message.php');
include('./functions/image_manager.php');

// delete category and redirect to manage category page
if (isset($_GET['id']) and isset($_GET['image-name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image-name'];

  // Remove image file if available
  if (!empty($image_name)) {
    $path = "../images/category/" . $image_name;

    $error_redirect = SITEURL . "admin/manage-category.php";
    // Remove image
    delete_image($path, $error_redirect);
  }

  // * Delete data from database

  // Create query
  $sql = "DELETE FROM tbl_category WHERE id=$id";
  // Execute query
  $res = mysqli_query($conn, $sql);

  if ($res) {
    $_SESSION['flash_message'] = array(
      "message" => "Category deleted!",
      "category" => "success"
    );
    header("location:" . SITEURL . "admin/manage-category.php");
  } else {
    $_SESSION['flash_message'] = array(
      "message" => "Couldn't delete category",
      "category" => "danger"
    );
    header("location:" . SITEURL . "admin/manage-category.php");
  }



  // Redirect to manage category
} else {
  // redirect to manage category page
  header("location:" . SITEURL . "admin/manage-category.php");
}
