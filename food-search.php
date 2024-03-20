<?php include("./partials-front/menu.php") ?>

<?php
$search = $_POST['search'];
?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">


        <?php
        // Query results similiar to query
        $sql_query = "SELECT * FROM tbl_food 
                      WHERE (title LIKE '%$search%' OR description LIKE '%$search%') 
                      AND active='yes' AND featured='yes'";

        $res_query = mysqli_query($conn, $sql_query);
        $row_count_query = mysqli_num_rows($res_query);

        if ($row_count_query === 0) {
            echo "<h2 class='text-center'>Couldn't Find Any Results</h2>";
        } else {
            echo "<h2 class='text-center'>Food Menu</h2>";
            while ($row = mysqli_fetch_assoc($res_query)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $price = $row['price'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if (empty($image_name)) {
                            echo '<h4>No Image</h4>';
                        } else {
                            $image_path = SITEURL . "images/food/" . $image_name;
                            echo "<img src='$image_path' alt='$image_name' class='img-responsive img-curve'>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price ?> 22</p>
                        <p class="food-detail">

                            <?php echo $description ?>
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