<?php
if (isset($_SESSION['flash_message'])) {
  $flashMessage = $_SESSION['flash_message'];

  // GET VALUES OF MESSAGE
  $flash_category = $flashMessage['category'];
  $flash_message = $flashMessage['message'];

  if ($flash_category == "success") {
?>
    <div class="message-success">
      <p>

        <?php
        echo $flash_message;
        ?>
      </p>
    </div>
  <?php
  } else if ($flash_category == "danger") {
  ?>
    <div class="message-danger">
      <?php
      echo $flash_message;
      ?>
    </div>
<?php
  }

  unset($_SESSION['flash_message']);
}
?>