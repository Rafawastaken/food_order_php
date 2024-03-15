<!DOCTYPE html>
<?php include("../config/constants.php") ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Login - Food Order Admin Panel</title>

</head>

<body>
  <?php
  include('../common/message.php');
  ?>

  <div class="login">
    <h1 class="text-center">Login</h1>


    <br />
    <form action="" method="post" class="text-center">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" placeholder="username">
      <br />
      <br />

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="password">
      <br />
      <br />

      <input type="submit" value="Login" class="btn-primary" name="submit">

    </form>
    <br />
    <p class="text-center">Created By: <a href="github.com/rafawastaken" target="_blank">Rafawastaken</a></p>
  </div>
</body>

</html>

<?php

// Check if the session destroy flag is set and destroy the session if it is
if (isset($_SESSION['destroy']) && $_SESSION['destroy'] == true) {
  session_destroy();
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hash_password = md5($password);

  $sql = "SELECT * FROM tbl_admin WHERE username='$username' and password='$hash_password'";
  $res = mysqli_query($conn, $sql);

  if ($res and mysqli_num_rows($res) === 1) {
    $flash_message = array("message" => "Welcome back $username", "category" => "success");

    $_SESSION['user'] = $username;
    $_SESSION['flash_message'] = $flash_message;
    header("location:" . SITEURL . "admin/index.php");
  } else {
    $flash_message = array('message' => "Incorrect Username or Password", "category" => "danger");
    $_SESSION['flash_message'] = $flash_message;
    header("location:" . SITEURL . "admin/login.php");
  }
}

?>