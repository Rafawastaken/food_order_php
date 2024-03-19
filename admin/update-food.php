<?php include('./functions/flash_message.php') ?>
<?php include('./functions/image_manager.php') ?>
<?php include('./partials/menu.php') ?>

<?php
if (isset($_GET['id']) and !empty($_GET['id'])) {
  $id = $_GET['id'];

  $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
  $res2 = mysqli_query($conn, $sql2);

  $row2 = mysqli_fetch_assoc($res2);

  $title = $row2['title'];
  $description = $row2['description'];
  $price = $row2['price'];
  $current_image = $row2['image_name'];
  $current_category = $row2['category_id'];
  $featured = $row2['featured'];
  $active = $row2['active'];
} else {
  flash_message("Need to provide ID of food to be updated", "danger");
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">

        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
          </td>
        </tr>

        <tr>
          <td>Description: </td>
          <td>
            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
          </td>
        </tr>

        <tr>
          <td>Price: </td>
          <td>
            <input type="number" name="price" value="<?php echo $price; ?>">
          </td>
        </tr>

        <tr>
          <td>Current Image: </td>
          <td>
            <?php
            if ($current_image == "") {
              //Image not Available 
              echo "<div class='error'>Image not Available.</div>";
            } else {
              //Image Available
            ?>
              <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
            <?php
            }
            ?>
          </td>
        </tr>

        <tr>
          <td>Select New Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td>Category: </td>
          <td>

            <select name="category" id="category">
              <?php
              // Query active categories 
              $sql_categories = "SELECT * FROM tbl_category WHERE active='yes'";
              $res_categories = mysqli_query($conn, $sql_categories);
              $value = 1;


              if (mysqli_num_rows($res_categories) > 0) {
                foreach ($res_categories as $res_category) {
              ?>
                  <option <?php if ($res_category['id'] == $current_category) echo "checked" ?> value="<?php echo $res_category['id'] ?>"><?php echo $res_category['title'] ?></option>
                <?php
                }
              } else {
                ?>
                <option value="0">No Categories Found</option>
              <?php
              }
              ?>
            </select>

          </td>
        </tr>

        <tr>
          <td>Featured: </td>
          <td>
            <input <?php if ($featured == "yes") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="yes"> Yes
            <input <?php if ($featured == "no") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="no"> No
          </td>
        </tr>

        <tr>
          <td>Active: </td>
          <td>
            <input <?php if ($active == "yes") {
                      echo "checked";
                    } ?> type="radio" name="active" value="yes"> Yes
            <input <?php if ($active == "no") {
                      echo "checked";
                    } ?> type="radio" name="active" value="no"> No
          </td>
        </tr>

        <tr>
          <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>
  </div>
</div>

<?php

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $current_image = $_POST['current_image'];
  $category = $_POST['category'];

  $featured = $_POST['featured'];
  $active = $_POST['active'];

  if (isset($_FILES['image']['name'])) {
    $image_name = $_FILES['image']['name'];

    if (!empty($image_name)) {
      $error_redirect_path = SITEURL . "admin/manage-food.php";
      $source_path = $_FILES['image']['tmp_name'];
      $upload_path = "../images/food/";

      if (empty($current_image)) {
        $image_name = upload_image($image_name, $source_path, $upload_path, $error_redirect_path);
      } else {
        $remove_path = "../images/food/" . $current_image;
        $image_name = update_image($image_name, $source_path, $error_redirect_path, $upload_path, $remove_path);
      }
    } else {
      $image_name = $current_image;
    }
  }

  //4. Update the Food in Database
  $sql3 = "UPDATE tbl_food SET 
   title = '$title',
   description = '$description',
   price = $price,
   image_name = '$image_name',
   category_id = '$category',
   featured = '$featured',
   active = '$active'
   WHERE id=$id
";

  //Execute the SQL Query
  $res3 = mysqli_query($conn, $sql3);

  if ($res3) {
    flash_message("Food: " . $title . "updated!", "success");
  } else {
    flash_message("Couldnt update food", "success");
  }

  header("location:" . SITEURL . "admin/manage-food.php");
}

?>

<?php include('./partials/footer.php') ?>