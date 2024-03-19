<?php

include('../config/constants.php');
include('./functions/image_manager.php');
include('./functions/flash_message.php');

if (isset($_GET['id']) and !empty($_GET['id'])) {
  $id = $_GET['id'];

  $sql_find_product = "SELECT * FROM tbl_food WHERE id=?";
  $stmt_find_food = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt_find_food, $sql_find_product)) {
    flash_message("Something went wrong while preparing sql statement", "danger");
    header('location:' . SITEURL . "admin/manage-food.php");
    die();
  }

  mysqli_stmt_bind_param($stmt_find_food, "i", $id);
  mysqli_stmt_execute($stmt_find_food);

  $res = mysqli_stmt_get_result($stmt_find_food);

  // Case not found in database
  if (!$res or mysqli_num_rows($res) === 0) {
    flash_message('Something went wrong while retrieving data from db', "danger");
    header("location:" . SITEURL . "admin/manage-food.php");
  }

  // Get data from food to be deleted
  if ($row = mysqli_fetch_assoc($res)) {
    // Check if there's an image to be deleted
    if (!empty($row['image_name'])) {
      $image_name = $row['image_name'];

      // ! HAS TO BE RELATIVE PATH !
      // $image_delete_path = SITEURL . "images/food/" . $image_name;
      $image_delete_path = "../images/food/" . $image_name;
      $error_path = SITEURL . "admin/manage-food.php";
      $image_deleted = delete_image($image_delete_path, $error_path);

      if (!$image_deleted) {
        flash_message("Something went wrong while deleting image", "danger");
        header("loaction:" . SITEURL . "admin/manage-food.php");
        die();
      }
    }
  }

  // Delete from database
  $sql_delete_food = "DELETE FROM tbl_food WHERE id = ?";
  $stmt_delete = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt_delete, $sql_delete_food)) {
    flash_message("Something went wrong while preparing delete query", "danger");
    header("location:" . SITEURL . "admin/manage-food.php");
    die();
  }

  // Create and execute prepared statement
  mysqli_stmt_bind_param($stmt_delete, 'i', $id);
  if (mysqli_stmt_execute($stmt_delete)) {
    flash_message("Food deleted!", "success");
  } else {
    flash_message("Couldnt delete food", "danger");
  }

  header("location:" . SITEURL . "admin/manage-food.php");
} else {
  flash_message("Couldn't find food to delete", "danger");
  header("location:" . SITEURL . "admin/manage-food.php");
  die();
}
