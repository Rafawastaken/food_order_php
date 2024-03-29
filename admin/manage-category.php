<?php include('./partials/menu.php') ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Categories</h1>

    <br /><br />
    <a href="<?php echo SITEURL . "admin/add-category.php" ?>" class="btn-primary">Add Category</a>
    <br /><br /><br />



    <!-- Table content -->
    <?php
    $sql = 'SELECT * FROM tbl_category';

    $res = mysqli_query($conn, $sql);
    $sn = 0;

    if ($res) {
      $rows = mysqli_num_rows($res);
      if ($rows === 0) {
    ?>
        <tr>
          <td colspan="5">
            <h3>No Categories added</h3>
          </td>
        </tr>
      <?php
      } else {
      ?>
        <table class="tbl-full">
          <!-- Table Heading -->
          <tr>
            <th>S.N</th>
            <th>Image</th>
            <th>Title</th>
            <th>Active</th>
            <th>Featured</th>
            <th>Actions</th>
          </tr>
        <?php
      }

      while ($rows = mysqli_fetch_assoc($res)) {
        $id = $rows['id'];
        $title = $rows['title'];
        $active = $rows['active'];
        $featured = $rows['featured'];
        $image_name = $rows['image_name'];
        $sn = $sn + 1;
        $delete_link = SITEURL . "admin/delete-category.php?id=" . $id . "&image-name=" . $image_name;
        $update_link = SITEURL . "admin/update-category.php?id=" . $id;

        ?>

          <tr>
            <td>
              <?php echo $sn ?>
            </td>

            <td>
              <?php if (!empty($image_name)) {
              ?>
                <img src="<?php echo SITEURL ?>/images/category/<?php echo $image_name ?>" alt="<?php echo $title ?> image" height="75" width="75">
              <?php
              } else {
                echo "No image";
              } ?>

            </td>

            <td>
              <?php echo $title ?>
            </td>
            <td>
              <?php echo $active ?>
            </td>
            <td>
              <?php echo $featured ?>
            </td>

            <td>
              <a href="<?php echo $update_link ?>" class="btn-primary">
                Update Category
              </a>
              <a href="<?php echo $delete_link ?>" class="btn-danger ms-2">
                Delete Category
              </a>
            </td>
          </tr>

      <?php
      }
    }

      ?>

      <!-- End of table content -->
        </table>
  </div>
</div>
<!-- Main content section ends -->

<?php include('./partials/footer.php') ?>