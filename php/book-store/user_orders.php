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
    <title>Orders Page</title>
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
                <h1 class="text-danger text-uppercase">Placed Orders</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_cart.php" class="text-decoration-none text-dark">Cart</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->

    <!------------------ start added products --------------------------->
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center text-uppercase text-danger mb-5">Placed Orders</h1>

            <div class="row justify-content-center">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_order = mysqli_fetch_assoc($select_orders)) {
                ?>
                        <div class="col-lg-6 p-2">
                            <div class="h-100 p-3 shadow" style="background:#f1f1f1;">
                                <p><i class="fas fa-clock"></i> <span class="fw-bold">Placed on :</span> <?php echo $fetch_order['placed_on'] ?></p>
                                <p><i class="fas fa-user"></i> <span class="fw-bold">Name :</span> <?php echo $fetch_order['name'] ?></p>
                                <p><i class="fas fa-phone-alt"></i> <span class="fw-bold">Phone :</span> <?php echo $fetch_order['number'] ?></p>
                                <p><i class="fas fa-envelope"></i> <span class="fw-bold">Email :</span> <?php echo $fetch_order['email'] ?></p>
                                <p><i class="fas fa-hand-holding-usd"></i> <span class="fw-bold">Payment Method :</span> <?php echo $fetch_order['method'] ?></p>
                                <p><i class="fas fa-map-marked"></i> <span class="fw-bold">Address :</span> <?php echo $fetch_order['address'] ?></p>
                                <p><i class="fas fa-list"></i> <span class="fw-bold">Order Items :</span> <?php echo $fetch_order['total_products'] ?></p>
                                <p><i class="fas fa-star"></i> <span class="fw-bold">Total Price :</span> $<?php echo $fetch_order['total_price'] ?></p>
                                <p><i class="fas fa-car"></i> <span class="fw-bold">Status :</span> <?php echo $fetch_order['payment_status'] ?></p>
                                <a href="user_orders.php?cancel_order=<?php echo $fetch_order['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?')">Cancel order</a>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="alert alert-info text-center h5">There is no order.</p>';
                }
                ?>
            </div>


            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-center py-4">

                        <a href="user_shop.php" class="btn btn-warning text-light mx-2">Continue Shopping</a>

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