<?php include("./partials-front/menu.php ") ?>
<!-- Navbar Section Ends Here -->

<?php
$category_id = $_GET['category_id'];
if (!isset($category_id) or empty($category_id)) {
    header("Location: " . SITEURL);
    exit; // Always exit after a header redirect
}

$sql_category = "SELECT title FROM tbl_category WHERE id='$category_id'";
$res_category = mysqli_query($conn, $sql_category);
$rows_category = mysqli_num_rows($res_category);

if ($rows_category === 0) {
    header('location:' . SITEURL);
    exit;
}

$row_category = mysqli_fetch_assoc($res_category);
$category_title = $row_category['title'];
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">

        <?php
        // Query foods inside category id
        $sql_foods_category = "SELECT * FROM tbl_food WHERE category_id='$category_id'";
        $res_foods_category = mysqli_query($conn, $sql_foods_category);
        $rows_foods_category = mysqli_num_rows($res_foods_category);

        if ($rows_foods_category === 0) {
            echo "<h2 class='text-center'>No Foods inside $category_title</h2>";
        } else {
            echo "<h2 class='text-center'>Found " . $rows_foods_category . " Food in $category_title</h2>";

            while ($row = mysqli_fetch_assoc($res_foods_category)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if (empty($image_name)) {
                            echo "<h4>No Image</h4>";
                        } else {
                            $image_path = SITEURL . "images/food/" . $image_name;
                            echo "<img src='$image_path' alt='$title' class='img-responsive img-curve'>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?>€</p>
                        <p class="food-detail"><?php echo $description; ?></p>
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