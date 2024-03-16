<?php include("./partials/menu.php") ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>

    <br />
    <br />

    <!-- Formulário para adicionar um novo administrador -->
    <form method="POST">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td>
            <input placeholder="Full Name" type="text" name="full_name" id="fullname" />
          </td>
        </tr>

        <tr>
          <td>Username:</td>
          <td>
            <input placeholder="Username" type="text" name="username" id="username" />
          </td>
        </tr>

        <tr>
          <td>Password:</td>
          <td>
            <input placeholder="Password" type="password" name="password" id="password" />
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<!-- Main content section ends -->

<?php include("./partials/footer.php") ?>

<?php
// Process value of form and save it into database

// Check if form has been submitted
if (isset($_POST['submit'])) {
  // Get values from form
  $fullname = $_POST['full_name'];
  $username = $_POST['username'];
  $password = $_POST['password']; // Do not hash here, do it just before inserting into database

  // Hash the password using bcrypt
  // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $hashed_password = md5($password);

  // SQL Query to insert data into database using prepared statements
  $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES (?, ?, ?)";

  // Initialize a prepared statement
  $stmt = mysqli_stmt_init($conn);

  // Prepare the prepared statement
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    // If SQL statement preparation fails, set an error message and redirect
    $flash_message = array(
      "category" => "danger",
      "message" => "Failed to add admin"
    );

    header("Location: " . SITEURL . 'admin/add-admin.php');
    exit();
  } else {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sss", $fullname, $username, $hashed_password);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Check whether the query was executed successfully
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      // If successful, set a success message and redirect
      $flash_message = array(
        "category" => "success",
        "message" => "Admin added successfully"
      );
    } else {
      // If failed, set an error message and redirect
      $flash_message = array(
        "category" => "success",
        "message" => "Failed to add admin"
      );
    }
  }

  $_SESSION['flash_message'] = $flash_message;
  header("Location: " . SITEURL . 'admin/manage-admin.php');
  exit();
}
?>