<?php include("./partials-front/menu.php") ?>

<?php
if (!isset($_GET['food_id'])) {
    $_SESSION['flash_message'] = array(
        "message" => "Failed to get id",
        "category" => "danger"
    );
    header('location:' . SITEURL);
    exit;
}
echo $food_id = $_GET['food_id'];
$sql_food = "SELECT * FROM tbl_food WHERE id='$food_id'";
$res_food = mysqli_query($conn, $sql_food);
$rows_food = mysqli_num_rows($res_food);

if ($rows_food === 0) {
    $_SESSION['flash_message'] = array(
        "message" => "Couldnt get rows",
        "category" => "danger"
    );
    header('location:' . SITEURL);
    header('location:' . SITEURL);
    exit;
}

$row = mysqli_fetch_assoc($res_food);
$id = $row['id'];
$title = $row['title'];
$price = $row['price'];
$image_name = $row['image_name'];


?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form class="order" action="<?php echo SITEURL . 'order.php?food_id=' . $food_id ?>" method='POST'>
            <fieldset>
                <legend>Selected Food</legend>

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
                    <h3><?php echo $title ?></h3>´
                    <input type="hidden" name="food" value='<?php echo $title ?>'>
                    <p class="food-price"><?php echo $price ?></p>
                    <input type="hidden" name="price" value='<?php echo $price ?>'>



                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                <input type="hidden" name="food_id" value="<?php echo $food_id ?>">
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>


        <?php
        if (isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order SET 
            food = '$food',
            price = $price,
            quantity = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            costumer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
        ";




            // Execute the statement
            $res2 = mysqli_query($conn, $sql2);

            // Check for successful insertion
            if ($res2) {
                $_SESSION['flash_message'] = array(
                    "message" => "order added",
                    "category" => "success"
                );
                header('location:' . SITEURL);
                exit;
            } else {
                $_SESSION['flash_message'] = array(
                    "message" => "Something went wrong 2",
                    "category" => "danger"
                );

                // echo "Error: " . mysqli_error($conn);
                header('location:' . SITEURL);
                exit;
            }
        }
        ?>
        <!-- fOOD sEARCH Section Ends Here -->


    </div>
</section>
<?php include("./partials-front/footer.php") ?>