<?php include("./partials/menu.php"); ?>
<?php include("./functions/image_manager.php") ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Food</h1>
    <br /><br />

    <form method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td><input type="text" name="title" id="title" /></td>
        </tr>

        <tr>
          <td>Description</td>
          <td>
            <textarea name="description" id="description" cols="30" rows="5"></textarea>
          </td>
        </tr>

        <tr>
          <td>Price (X.YY)€</td>
          <td><input name="price" id="price" pattern="^\d*(\.\d{0,2})?$" /></td>
        </tr>

        <tr>
          <td>Select Image</td>
          <td><input type="file" name="image" id="image" /></td>
        </tr>

        <tr>
          <td>Select Category</td>
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
                  <option value="<?php echo $res_category['id'] ?>"><?php echo $res_category['title'] ?></option>
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
          <td>Featured</td>
          <td>
            Yes <input type="radio" name="featured" id="yes" value="yes" />
            No <input type="radio" name="featured" id="yes" value="no" />
          </td>
        </tr>

        <tr>
          <td>Active</td>
          <td>
            Yes <input type="radio" name="active" id="active" value="yes" />
            No <input type="radio" name="active" id="active" value="no" />
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input name="submit" type="submit" value="submit" class="btn-secondary" value="Create New Product">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];

  $featured = "no";
  $active = "no";

  $image_name = "";

  if (isset($_POST['featured'])) {
    $featured = $_POST['featured'];
  }

  if (isset($_POST['active'])) {
    $active = $_POST['active'];
  }

  // Check if image was selected and upload it
  if (isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {
    $image_name = $_FILES['image']['name'];
    $source_path = $_FILES['image']['tmp_name'];
    $upload_path = "../images/food/";
    $error_redirect_path = SITEURL . "admin/manage-food.php";

    $image_name = upload_image($image_name, $source_path, $upload_path, $error_redirect_path);
  }

  $sql_insert_food = "INSERT INTO tbl_food SET
  title='$title',
  description='$description',
  price='$price',
  category_id='$category',
  image_name='$image_name',
  featured='$featured',
  active='$active'";

  $red_new_food = mysqli_query($conn, $sql_insert_food);

  if ($red_new_food) {
    $_SESSION['flash_message'] = array(
      "message" => "Food: " . $title . " added",
      "category" => "success"
    );
    header("location:" . SITEURL . "admin/manage-food.php");
  } else {
    $_SESSION['flash_message'] = array(
      "message" => "Something went wrong while adding food",
      "category" => "danger"
    );

    header("location:" . SITEURL . "admin/manage-food.php");
  }
}
?>

<?php include("./partials/footer.php"); ?>