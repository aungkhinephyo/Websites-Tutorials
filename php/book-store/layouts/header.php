<?php if (isset($messages)) : ?>
    <div class="alert alert-info alert-dismissible text-center fade show">
        <?php
        foreach ($messages as $message) {
            echo "<strong>$message</strong><br>";
        }
        ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>


<nav class="navbar navbar-expand-lg p-3 shadow align-items-center">

    <a href="#" class="navbar-brand"><span class="h2">Dream</span><span class="text-danger h3">Book</span></a>

    <div class="order-lg-2 d-flex align-items-center icons">

        <a href="user_search.php" class="mx-2"><i class="fas fa-search"></i></a>

        <div class="login_info_container">
            <a href="javascript:void(0);" class="mx-2"><i class="fas fa-user user_icon"></i></a>

            <div class="login_info">
                <p class="fw-bold">Username: <span class="text-success">
                        <?php echo $_SESSION['user_name'] ?></span>
                </p>
                <p class="fw-bold">Email: <span class="text-success">
                        <?php echo $_SESSION['user_email'] ?></span>
                </p>
                <div class="text-center">
                    <a href="logout.php" class="btn btn-danger w-50 mb-3 text-light">Logout</a>
                    <p>new <a href="login.php">Login</a> | <a href="register.php">Register</a></p>
                </div>
            </div>
        </div>

        <?php

        $select_carts = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id' ") or die("query failed!");
        $total_num_carts = mysqli_num_rows($select_carts);

        ?>
        <a href="user_cart.php" class="mx-2"><i class="fas fa-shopping-cart"></i> <span class="order_list">(<?php echo $total_num_carts ?>)</span></a>

        <button type="button" class="navbar-toggler"><span class="navbar-toggler-icon" data-bs-target="#mynav" data-bs-toggle="collapse"></span></button>
    </div>

    <div id="mynav" class="navbar-collapse collapse">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a href="user_home.php" class="nav-link fs-5 mx-3">Home</a></li>
            <li class="nav-item"><a href="user_about.php" class="nav-link fs-5 mx-3">About</a></li>
            <li class="nav-item"><a href="user_shop.php" class="nav-link fs-5 mx-3">Shop</a></li>
            <li class="nav-item"><a href="user_contact.php" class="nav-link fs-5 mx-3">Contact</a></li>
            <li class="nav-item"><a href="user_orders.php" class="nav-link fs-5 mx-3">Orders</a></li>
        </ul>
    </div>

</nav>