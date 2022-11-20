<?php

require_once "./provider/connection.php";
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page Overview</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

    <!-- custom admin css -->
    <link rel='stylesheet' href="./css/admin.css" type="text/css" />
</head>

<body class="bg-secondary">
    <?php require_once("./layouts/admin_header.php"); ?>

    <section class="text-danger mt-3">
        <div class="container">
            <h1 class="text-warning text-center text-uppercase my-5">Admin Dashboard</h1>

            <div class="row">

                <!-- pending noti -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php
                        $total_pendings = 0;
                        $select_pending = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='pending'") or die('query failed');

                        if (mysqli_num_rows($select_pending) > 0) {
                            while ($fetch_pending = mysqli_fetch_assoc($select_pending)) {
                                $total_price = $fetch_pending['total_price'];
                                $total_pendings += $total_price;
                            }
                        }
                        ?>
                        <h3 class="display-4 mb-3">$<?php echo $total_pendings; ?>/-</h3>
                        <a href="admin_orders.php" class="btn btn-info w-75">Total Pendings</a>
                    </div>
                </div>

                <!-- payment completed noti -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $total_completed = 0;
                        $select_completed = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='completed'") or die('query failed');

                        if (mysqli_num_rows($select_completed) > 0) {
                            while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                                $total_price = $fetch_completed['total_price'];
                                $total_completed += $total_price;
                            }
                        }
                        ?>
                        <h3 class="display-4 mb-3">$<?php echo $total_completed; ?>/-</h3>
                        <a href="admin_orders.php" class="btn btn-info w-75">Payment Completed</a>

                    </div>
                </div>

                <!-- orders noti -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $select_order = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                        $total_orders = mysqli_num_rows($select_order);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_orders; ?></h3>
                        <a href="#" class="btn btn-info w-75">Orders Placed</a>

                    </div>
                </div>

                <!-- total products  -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                        $total_products = mysqli_num_rows($select_product);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_products; ?></h3>
                        <a href="admin_products.php" class="btn btn-info w-75">Total Products</a>

                    </div>
                </div>

                <!--  Messages  -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $select_message = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                        $total_messages = mysqli_num_rows($select_message);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_messages; ?></h3>
                        <a href="admin_messages.php" class="btn btn-info w-75">Messages</a>

                    </div>
                </div>

                <!-- total accounts  -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                        $total_accounts = mysqli_num_rows($select_account);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_accounts; ?></h3>
                        <a href="admin_users.php" class="btn btn-info w-75">Total Accounts</a>

                    </div>
                </div>

                <!-- total normal users  -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php

                        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='user' ") or die('query failed');
                        $total_users = mysqli_num_rows($select_user);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_users; ?></h3>
                        <a href="admin_users.php" class="btn btn-info w-75">Normal Users</a>

                    </div>
                </div>

                <!--  admins  -->
                <div class="col-lg-4 col-md-6 text-center p-3 mb-3">
                    <div class="h-100 p-5 border shadow rounded-3 bg-light">
                        <?php
                        
                        $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='user' ") or die('query failed');
                        $total_admins = mysqli_num_rows($select_admin);

                        ?>
                        <h3 class=" display-4 mb-3"><?php echo $total_admins; ?></h3>
                        <a href="admin_users.php" class="btn btn-info w-75">Admin</a>

                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom admin js -->
    <script src="./js/admin.js"></script>
</body>

</html>