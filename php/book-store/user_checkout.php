<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("Location: login.php");
}

if (isset($_POST['orderBtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = $_POST['phone'];
    $method = $_POST['payment_method'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $placed_on = date('j-M-Y g:i');

    $cart_products = [];
    $cart_total_price = 0;

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {

            $cart_products[] = "{$cart_item['name']} ({$cart_item['quantity']})";

            $sub_total = $cart_item['price'] * $cart_item['quantity'];
            $cart_total_price += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);
    $total_price = $cart_total_price;

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id='$user_id' AND name='$name' AND email='$email' AND number='$phone' AND method='$method' AND address='$address' AND placed_on='$placed_on' AND total_products='$total_products' AND total_price='$total_price' ") or die('query failed');

    if ($total_price == 0) {
        $messages[] = 'Your cart is empty.';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $messages[] = 'Order has been already placed.';
        } else {
            mysqli_query($conn, "INSERT INTO `orders` (user_id,name,number,email,method,address,total_products,total_price,placed_on) VALUES('$user_id','$name','$phone','$email','$method','$address','$total_products','$total_price','$placed_on')") or die('query failed');

            $messages[] = 'Your order is successfully placed.';

            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id' ") or die('query failed');
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
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
                <h1 class="text-danger text-uppercase">Checkout</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_contact.php" class="text-decoration-none text-dark">Checkout</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->
    <!------------------ start orders --------------------------->
    <section class="py-5">
        <div class="container">

            <?php
            $total ??= 0;
            $select_carts = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

            if (mysqli_num_rows($select_carts) > 0) {
            ?>
                <div class="d-flex flex-wrap justify-content-center">
                    <?php

                    while ($fetch_cart = mysqli_fetch_assoc($select_carts)) {
                        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $total += $sub_total;
                    ?>
                        <p class="bg-dark text-light py-2 px-3 mx-2"><?php echo $fetch_cart['name'] ?> ( <span>$<?php echo $fetch_cart['price'] . ' x ' .  $fetch_cart['quantity'] ?></span> )</p>

                    <?php
                    }
                    ?>
                </div>

                <div class="text-center text-danger fs-4">Overall Price: $<?php echo $total ?>/-</div>

                <div class="mt-4">
                    <div class="row justify-content-center p-2">
                        <div class="col-lg-6 bg-light border shadow-sm rounded-3 p-md-5 p-3">
                            <h4 class="text-center mb-3">Place Your Order</h4>
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="eg.Nara Jessica" required autofocus />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="eg.nara@gmail.com" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="eg.Nara Jessica" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Payment Method</label>
                                    <select name="payment_method" class="form-select">
                                        <option value="kpay">Kpay</option>
                                        <option value="cbpay">CB pay</option>
                                        <option value="cash on delivery">Cash On Delivery</option>
                                        <option value="credit card">Credit Card</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Please fill the address in details.</label>
                                    <textarea name="address" rows="2" class="form-control" style="resize:none;" placeholder="eg. No(221), Flat No.(2), Baker St, Dagon Township, Yangon" required></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="orderBtn" class="btn btn-primary">Order Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <h5 class="alert alert-info text-center mb-4">There is no item in your cart. <a href="user_shop.php" class="text-decoration-none">Go shopping</a> <i class="fas fa-arrow-right"></i> </h5>

            <?php
            }
            ?>




        </div>
    </section>

    <!------------------ end orders --------------------------->


    <?php require_once "./layouts/footer.php"; ?>

    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- user js -->
    <script src="./js/user.js"></script>
</body>

</html>