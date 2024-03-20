<?php include "./partials-front/menu.php"; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo SITEURL . 'food-search.php' ?>" method="POST">
      <input type="search" name="search" placeholder="Search for Food.." required />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- Categories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>

    <?php
    // Create sql query to display categories
    $sql_categories = "SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' LIMIT 3";
    $res_categories = mysqli_query($conn, $sql_categories);
    $count_categories = mysqli_num_rows($res_categories);

    if ($count_categories > 0) {
      while ($row = mysqli_fetch_assoc($res_categories)) {

        $id = $row["id"];
        $title = $row["title"];
        $image_name = $row["image_name"];
    ?>
        <a href="category-foods.php?category_id=<?php echo $id ?>">
          <div class="box-3 float-container">

            <?php if (empty($image_name)) {
              echo "<h3>Image not available</h3>";
            } else {
              $image_link = SITEURL . "/images/category/" . $image_name;
              echo "<img src='$image_link' class='img-responsive img-curve' />";
            } ?>
            <h3 class="float-text text-white">
              <?php echo $title; ?>
            </h3>
          </div>
        </a>
      <?php
      }
    } else {
      ?>
      <h1>Categroies Not Available</h1>
    <?php
    }
    ?>
    <!-- Categories Section ENDS Here -->

    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <?php
    $sql_foods = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 6";
    $res_foods = mysqli_query($conn, $sql_foods);
    $rows_foods = mysqli_num_rows($res_foods);

    if ($rows_foods === 0) {
      echo "<h2 class='text-center'>No Foods Available</h2>";
    } else {
      echo "<h2 class='text-center'>Foods Menu</h2>";
      while ($row = mysqli_fetch_assoc($res_foods)) {
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    ?>
        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            if (empty($image_name)) {
              echo "<h3>No Image </h3>";
            } else {
              $image_path = SITEURL . "/images/food/" . $image_name;
              echo "<img src='$image_path' alt='$title' class='img-responsive img-curve' />";
            }
            ?>
          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title ?></h4>
            <p class="food-price"><?php echo $price ?>€</p>
            <p class="food-detail">
              <?php echo $description ?>
            </p>
            <br />

            <a href="order.php" class="btn btn-primary">Order Now</a>
          </div>
        </div>
    <?php
      }
    }
    ?>

    <div class="clearfix"></div>
  </div>

  <p class="text-center">
    <a href="<?php echo SITEURL . 'foods.php' ?>">See All Foods</a>
  </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include "./partials-front/footer.php"; ?>