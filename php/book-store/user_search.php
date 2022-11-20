<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

$total ??= 0;
if (!isset($user_id)) {
    header("Location: login.php");
}

if (isset($_GET['cancel_order'])) {
    $id = $_GET['cancel_order'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id='$id'") or die('query failed');
    $messages[] = 'Your order is canceled.';
    header('Location: user_orders.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
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
                <h1 class="text-danger text-uppercase">Search Books</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_shop.php" class="text-decoration-none text-dark">Shop</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->

    <!------------------ start added products --------------------------->
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center text-uppercase text-danger mb-5">Search Books</h1>

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="Search" autofocus />
                            <button type="submit" name="searchBtn" class="input-group-text btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-4">
                <?php
                if (isset($_POST['searchBtn'])) {
                    $searchKey = $_POST['search'];
                    $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$searchKey}%' ORDER BY price ") or die('query failed');
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
                        echo '<p class="alert alert-info text-center h5">There is no books like this name.</p>';
                    }
                } else {
                    echo '<p class="alert alert-info text-center h5">Search any books you wanna read.</p>';
                }
                ?>
            </div>
    </section>
    <!------------------ end added products --------------------------->


    <?php require_once "./layouts/footer.php"; ?>

    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- user js -->
    <script src="./js/user.js"></script>
</body>

</html>