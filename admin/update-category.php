<?php include("./partials/menu.php") ?>
<?php include("./functions/image_manager.php") ?>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  #create sql to get category info
  $sql = "SELECT * FROM tbl_category WHERE id=$id";

  // Execute query
  $res = mysqli_query($conn, $sql);

  // Count rows to check whether the ID is valid or not
  $count = mysqli_num_rows($res);

  if ($count === 1) {
    // GET all data
    $row = mysqli_fetch_assoc($res);

    // Create variables to each data
    $title = $row['title'];
    $current_image_name = $row['image_name'];
    $active = $row['active'];
    $featured = $row['featured'];
  } else {
    // Flash error and Redirect to manage category
    $_SESSION['flash_message'] = array(
      "message" => "Category not found.",
      "category" => "danger"
    );
    header("location:" . SITEURL . "admin/manage-category.php");
  }
} else {
  // IF category id isnt set
  $_SESSION['flash_message'] = array(
    "message" => "Category ID must set",
    "category" => "danger"
  );
  header("location:" . SITEURL . "admin/manage-category.php");
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>
    <br><br>

    <!-- Update category Form starts -->
    <form method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Category name: </td>
          <td>
            <input type="text" name="title" id="category_name" value="<?php echo $title ?>" />
          </td>
        </tr>

        <tr>
          <td>New Image</td>
          <td>

            <?php
            if (!empty($current_image_name)) {
            ?>
              <img src="<?php echo SITEURL . "images/category/" . $current_image_name ?>" width="150" />
            <?php
            } else {
            ?>
              <p>Image not added.</p>
            <?php
            }
            ?>

            <input type="file" name="image" id="image" />
          </td>
        </tr>

        <tr>
          <td>Featured: </td>
          <td>
            <input <?php if ($featured == "yes") echo "checked" ?> type="radio" name="featured" id="featured" value="yes" /> Yes
            <input <?php if ($featured == "no") echo "checked" ?> type="radio" name="featured" id="featured" value="no" /> No
          </td>
        </tr>

        <tr>
          <td>Active</td>
          <td>
            <input <?php if ($active == "yes") echo "checked" ?> type="radio" name="active" id="Active" value="yes"> Yes
            <input <?php if ($active == "no") echo "checked" ?> type="radio" name="active" id="Active" value="no"> No
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="current_image" value="<?php echo $current_image_name ?>" />
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php
// Update category
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $current_image = $_POST['current_image'];
  $title = $_POST['title'];
  $featured = $_POST['featured'];
  $active = $_POST['active'];

  echo $current_image;

  // Update new image if selected
  // Check if image is selected or not
  if (isset($_FILES['image']['name'])) {
    // Get image details
    $image_name = $_FILES['image']['name'];

    if (!empty($image_name)) {
      $error_redirect_path = SITEURL . "admin/manage-category.php";
      $source_path = $_FILES['image']['tmp_name'];
      $upload_path = "../images/category/";

      if (empty($current_image)) {
        $image_name = upload_image($image_name, $source_path, $upload_path, $error_redirect_path);
      } else {
        $remove_path = "../images/category/" . $current_image;
        $image_name = update_image($image_name, $source_path, $error_redirect_path, $upload_path, $remove_path);
      }
    } else {
      $image_name = $current_image;
    }
  }

  // Update database
  $sql2 = "UPDATE tbl_category SET 
      title='$title',
      featured='$featured',
      active='$active',
      image_name='$image_name'
      WHERE id='$id'
      ";

  // Execute query
  $res2 = mysqli_query($conn, $sql2);

  // Redirect to manage category
  // Check if query was executed 
  if ($res2) {
    $_SESSION['flash_message'] = array(
      "message" => "Category updated",
      "category" => "success"
    );

    header("location:" . SITEURL . "admin/manage-category.php");
  } else {
    $_SESSION['flash_message'] = array(
      "message" => "Failed to update category",
      "category" => "danger"
    );
  }
}
?>


<?php include("./partials/footer.php") ?>