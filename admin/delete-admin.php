<?php
// include constants.php
include('../config/constants.php');

// get ID of Admin to be deleted
$id = $_GET['id'];
$username = $_GET['username'];


// Create SQL query (using prepared statements to prevent SQL injection)
$sql = "DELETE FROM tbl_admin WHERE id=?";

// Initialize a prepared statement
$stmt = mysqli_stmt_init($conn);

// Prepare the prepared statement
if (!mysqli_stmt_prepare($stmt, $sql)) {
  // SQL statement preparation failed
  $flash_message = array(
    "message" => "Failed to prepare SQL statement",
    "category" => "success"
  );
} else {
  // Bind parameters to the prepared statement as strings
  mysqli_stmt_bind_param($stmt, "i", $id);

  // Execute the prepared statement
  if (mysqli_stmt_execute($stmt)) {
    // Admin deleted successfully
    $flash_message = array(
      "message" => "Admin " . $username  . " Deleted Successfully",
      "category" => "success"
    );
  } else {
    $flash_message = array(
      "message" => "Failed to delete admin",
      "category" => "success"
    );
  }
}

$_SESSION['flash_message'] = $flash_message;

// Close the prepared statement
mysqli_stmt_close($stmt);

// Redirect to admin management page with message (success/error)
header("Location: " . SITEURL . "admin/manage-admin.php");
exit();
