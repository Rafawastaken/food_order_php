<?php include('./partials/menu.php') ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Food</h1>

    <br /><br />
    <a href="<?php echo SITEURL . "admin/add-food.php" ?>" class="btn-primary">Add Food</a>
    <br /><br /><br />


    <?php
    $sql_query_food = "SELECT * FROM tbl_food";
    $res_foods = mysqli_query($conn, $sql_query_food);

    if (!$res_foods || mysqli_num_rows($res_foods) === 0) {
    ?>
      <h2><?php echo !$res_foods ? "Something went wrong getting the Foods" : "No Foods to display"; ?></h2>
    <?php
      die();
    } else {

    ?>
      <table class="tbl-full">
        <!-- Table Heading -->
        <tr>
          <th>S.N</th>
          <th>Image</th>
          <th>Title</th>
          <th>Price</th>
          <th>Category</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Controllers</th>
        </tr>
      <?php
    }

    $sn = 0;
    foreach ($res_foods as $query_food) {
      ?>
        <tr>
          <td><?php echo $sn + 1 ?></td>
          <td>
            <img src="<?php echo SITEURL . 'images/food/' . $query_food['image_name'] ?>" alt="food image" width="75">
          </td>
          <td><?php echo $query_food['title'] ?></td>
          <td><?php echo $query_food['price'] ?> €</td>
          <td><?php
              $category_id = $query_food['category_id'];
              $sql_query_category = "SELECT * FROM tbl_category WHERE id = '$category_id'";
              $res_category = mysqli_query($conn, $sql_query_category);

              if ($res_category && mysqli_num_rows($res_category) > 0) {
                $category_row = mysqli_fetch_assoc($res_category);
                $category_title = $category_row['title'];

                echo $category_title;
              } else {
                echo "Couldn't find category";
              }
              ?></td>
          <td><?php echo $query_food['featured'] ?></td>
          <td><?php echo $query_food['active'] ?></td>
          <td>
            <a href="#" class="btn-secondary">
              Update Food
            </a>
            <a href="#" class="btn-danger ms-2">
              Delete Food
            </a>
          </td>
        </tr>
      <?php
      $sn++;
    }
      ?>

      </table>
      <!-- End of table content -->
  </div>
</div>
<!-- Main content section ends -->

<?php include('./partials/footer.php') ?>