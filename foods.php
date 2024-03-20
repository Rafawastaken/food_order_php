<?php include("./partials-front/menu.php") ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL . 'food-search.php' ?>" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <?php
        $sql_foods = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes'";
        $res_foods = mysqli_query($conn, $sql_foods);
        $rows_foods = mysqli_num_rows($res_foods);

        if ($rows_foods === 0) {
            echo '<h2 class="text-center">No Foods Available</h2>';
        } else {
            echo '<h2 class="text-center">Food Menu</h2>';

            while ($row = mysqli_fetch_assoc($res_foods)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name  = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if (empty($image_name)) {
                            echo "<h4>No image found</h4>";
                        } else {
                            $image_path = SITEURL . 'images/food/' . $image_name;
                            echo "<img src='$image_path' alt='$title' class='img-responsive img-curve'>";
                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?>€</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        }


        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("./partials-front/footer.php") ?>