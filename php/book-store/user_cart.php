<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

$total ??= 0;
if (!isset($user_id)) {
    header("Location: login.php");
}
if (isset($_POST['cartDelete'])) {
    $id = $_POST['cart_id'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$id' ") or die('query failed');
    $messages[] = 'Selected item is removed from cart.';
}
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` ") or die('query failed');
    $messages[] = 'All items are removed from cart.';
    header("Location: user_cart.php");
}
if (isset($_POST['updateQuantity'])) {
    $id = $_POST['cart_id'];
    $quantity = $_POST['product_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity='$quantity' WHERE id='$id' ") or die('query failed');
    $messages[] = 'Cart quantity updated.';
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
                <h1 class="text-danger text-uppercase">Shopping Cart</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_cart.php" class="text-decoration-none text-dark">Cart</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->

    <!------------------ start added products --------------------------->
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center text-uppercase text-danger mb-5">Items in your cart</h1>

            <div class="row">
                <?php
                $select_carts = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                if (mysqli_num_rows($select_carts) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_carts)) {
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-8 mx-auto p-3">
                            <div class="h-100 p-4 rounded-3 shadow product">

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <img src="<?php echo $fetch_cart['image_path'] ?>" width="200px">

                                    <p class="fw-bold fs-5 mb-1"><?php echo $fetch_cart['name'] ?></p>

                                    <p class="text-danger h5 mb-3">$<?php echo $fetch_cart['price'] ?>/-</p>

                                    <input type="hidden" name="cart_id" value="<?php echo  $fetch_cart['id'] ?>">

                                    <button type="submit" class="cart_delete" name="cartDelete" onclick="return confirm('Are you sure to remove this item?')"><i class="fas fa-times text-light"></i></button>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="number" name="product_quantity" id="quantity" class="form-control w-50" value="<?php echo $fetch_cart['quantity'] ?>" min="1" />

                                        <button type="submit" class="btn btn-warning" name="updateQuantity">Update</button>
                                    </div>

                                    <p class="h6 mt-3 mb-0">Sub Total: <span class="text-danger">$<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'] ?>/-</span></p>
                                </form>

                            </div>
                        </div>


                <?php
                        $total += $sub_total;
                    }
                } else {
                    echo '<p class="alert alert-info text-center h5">Your cart is empty.</p>';
                }
                ?>
            </div>


            <div class="row mt-5">
                <div class="col-12 mb-3 text-center">

                    <a href="user_cart.php?delete_all" class="btn btn-danger px-5 py-2" onclick="return confirm('Are you sure to delete all?')">Delete All</a>

                </div>
                <div class="col-12">
                    <div class="text-center border shadow py-4">
                        <h4>Overall Price: <span class="text-danger">$<?php echo $total ?></span>/-</h4>

                        <div class="mt-4">
                            <a href="user_shop.php" class="btn btn-warning text-light mx-2">Continue Shopping</a>
                            <a href="user_checkout.php" class="btn btn-primary text-light mx-2">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>

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