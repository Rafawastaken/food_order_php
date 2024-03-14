<?php include("./partials/menu.php") ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>
    <br />
    <br />

    <form action="#" method="POST">
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
  // Get values from database
  $fullname = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  // SQL Query to insert data into database
  $sql = "INSERT INTO tbl_admin SET
    full_name = '$fullname',
    username = '$username',
    password = '$password'
  ";

  // Variables defined in constants.php
  // Executing data into datbase
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  // Check whether the data was executed correctly
  if ($res === TRUE) {
    // Display data inserted message

    // Create variable to display message
    $_SESSION["add"] = "Admin Added successfully";
    // Redirect page main admin
    header("location:" . SITEURL . 'admin/add_admin.php');
  } else {
    // Display failed to insert data

    // Create variable to display message
    $_SESSION["add"] = "Failed to add admin";
    // Redirect page main admin
    header("location:" . SITEURL . 'admin/add_admin.php');
  }
}
?>