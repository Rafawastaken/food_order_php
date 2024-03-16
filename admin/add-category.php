<?php include("./partials/menu.php") ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <br><br>

    <!-- Add category Form starts -->
    <form method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Category name: </td>
          <td>
            <input type="text" name="title" id="category_name" />
          </td>
        </tr>

        <tr>
          <td>Select Image</td>
          <td><input type="file" name="image" id="image" /></td>
        </tr>

        <tr>
          <td>Featured: </td>
          <td>
            <input type="radio" name="featured" id="featured" value="yes" /> Yes
            <input type="radio" name="featured" id="featured" value="no" /> No
          </td>
        </tr>

        <tr>
          <td>Active</td>
          <td>
            <input type="radio" name="active" id="Active" value="yes"> Yes
            <input type="radio" name="active" id="Active" value="no"> No
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <!-- Add category Form ends -->
    <?php

    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $featured = "no";
      $active = "no";
      $image_name = "";

      if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
      }

      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      }


      if (isset($_FILES['image']['name'])) {
        // need image name, source_path and destination
        $image_name = $_FILES['image']['name'];
        $source_path = $_FILES['image']['tmp_name'];

        // Rename image names
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = "category_image_" . uniqid() . '.' . $ext;
        $destination_path = "../images/category/" . $image_name;

        // Upload image
        $upload = move_uploaded_file($source_path, $destination_path);

        // Check if image was not uploaded
        if ($upload == false) {
          $_SESSION['flash_message'] = array(
            "message" => "Couldn't upload image.",
            "category" => "danger"
          );
          header("location:" . SITEURL . "admin/add-category.php");
          die();
        }
      }

      echo $image_name;


      $sql = "INSERT INTO tbl_category SET 
        title='$title', 
        featured='$featured', 
        active='$active', 
        image_name='$image_name'";

      $res = mysqli_query($conn, $sql);

      // https://youtu.be/_Sxo-ASOatc?si=3B5A-sI3QrTHnC9p&t=2009

      if ($res) {
        // Query executed
        $_SESSION['flash_message'] = array(
          "message" => "Category '" . $title . "' added succesfully",
          "category" => "success"
        );
        header('location:' . SITEURL . "admin/manage-category.php");
      } else {
        // Failed to query
        $_SESSION['flash_message'] = array(
          "message" => "Something went wrong while adding category",
          "category" => "danger"
        );
        header('location:' . SITEURL . "admin/add-category.php");
      }
    }
    ?>


  </div>
</div>

<?php include("./partials/footer.php") ?>