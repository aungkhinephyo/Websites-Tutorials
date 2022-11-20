<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("Location: login.php");
}

if (isset($_POST['add_to_cart'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image_path = $_POST['product_image_path'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id' AND name='$product_name' ") or die("query failed!");

    if (mysqli_num_rows($check_cart_numbers) > 0) {

        $messages[] = "This item has been already added to cart.";
    } else {

        mysqli_query($conn, "INSERT INTO `cart` (user_id,name,price,quantity,image_path) VALUES('$user_id','$product_name','$product_price','$product_quantity','$product_image_path') ") or die('query failed!!');

        $messages[] = "This item is successfully added to cart.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

    <!-- custom admin css -->
    <link rel='stylesheet' href="./css/user.css" type="text/css" />
</head>

<body>

    <?php require_once "./layouts/header.php"; ?>

    <!------------------ start banner --------------------------->
    <section id="about_banner">
        <div class="container">
            <div class="text-center w-50 mx-auto">
                <h1 class="text-danger text-uppercase">Our Shop</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_shop.php" class="text-decoration-none text-dark">Shop</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->

    <!------------------ start latest products --------------------------->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <h1 class="text-center text-uppercase text-danger mb-5">Choose Products</h1>

            <div class="row">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-8 mx-auto p-3">
                            <div class="h-100 p-4 rounded-3 shadow product">

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="product_name" value="<?php echo  $fetch_product['name'] ?>">
                                    <input type="hidden" name="product_price" value="<?php echo  $fetch_product['price'] ?>">
                                    <input type="hidden" name="product_image_path" value="<?php echo $fetch_product['image_path'] ?>">

                                    <span class="price">$<?php echo $fetch_product['price'] ?>/-</span>

                                    <img src="<?php echo $fetch_product['image_path'] ?>" width="200px">

                                    <p class="fw-bold fs-5"><?php echo $fetch_product['name'] ?></p>

                                    <div>
                                        <input type="number" name="product_quantity" id="quantity" class="form-control mb-3" value="1" min="1" />

                                        <button type="submit" class="btn btn-primary" name="add_to_cart">Add to cart</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo '<p class="alert alert-info text-center">There is no products to show yet.</p>';
                }
                ?>
            </div>

            <div class="text-center mt-4">
                <a href="user_shop.php" type="button" class="btn btn-warning">Load more</a>
            </div>
        </div>
    </section>
    <!------------------ end latest products --------------------------->


    <?php require_once "./layouts/footer.php"; ?>

    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- user js -->
    <script src="./js/user.js"></script>
</body>

</html>