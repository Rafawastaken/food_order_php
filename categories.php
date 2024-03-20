<?php include("./partials-front/menu.php") ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">


        <?php
        $sql_categories = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes'";
        $res_categories = mysqli_query($conn, $sql_categories);
        $row_count = mysqli_num_rows($res_categories);


        if ($row_count === 0) {
        ?>
            <h2 class="text-center">No Categories Available</h2>
        <?php
        } else {
        ?>
            <h2 class="text-center">Explore Foods</h2>
            <?php

            while ($row = mysqli_fetch_assoc($res_categories)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

            ?>
                <a href="category-foods.php?category_id=<?php echo $id ?>">
                    <div class="box-3 float-container">
                        <?php
                        if (empty($image_name)) {
                            echo "<h4>No Image found</h4>";
                        } else {
                            $image_link = SITEURL . "images/category/" . $image_name;
                            echo "<img src='$image_link' alt='$title' class='img-responsive img-curve'>";
                        }
                        ?>
                        <h3 class="float-text"><?php echo $title ?></h3>

                    </div>
                </a>
        <?php
            }
        }

        ?>






        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include("./partials-front/footer.php") ?>