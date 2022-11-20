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


<nav class="navbar navbar-expand-lg bg-dark navbar-dark align-items-center p-3 shadow">

    <a href="admin_page.php" class="navbar-brand mx-3"><span class="h2">Admin</span><span class="text-danger h3">Panel</span></a>

    <div class="order-lg-2 ms-auto me-3 login_info">

        <a href="javascript:void(0);" class="nav-link text-white"><i class="fas fa-user user_icon"></i></a>

        <div class="info_box">
            <p class="fw-bold">Username: <span class="text-success">
                    <?php echo $_SESSION['admin_name']; ?></span>
            </p>
            <p class="fw-bold">Email: <span class="text-success">
                    <?php echo $_SESSION['admin_email']; ?></span>
            </p>
            <div class="text-center">
                <a href="logout.php" class="btn btn-danger w-50 mb-3">Log out</a>
                <p>new <a href="login.php">Login</a> | <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>

    <button type="button" class="navbar-toggler" data-bs-target="#mynav" data-bs-toggle="collapse"><i class="navbar-toggler-icon"></i></button>


    <div id="mynav" class="navbar-collapse collapse">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a href="admin_page.php" class="nav-link mx-3">Home</a></li>
            <li class="nav-item"><a href="admin_products.php" class="nav-link mx-3">Products</a></li>
            <li class="nav-item"><a href="admin_orders.php" class="nav-link mx-3">Orders</a></li>
            <li class="nav-item"><a href="admin_users.php" class="nav-link mx-3">Users</a></li>
            <li class="nav-item"><a href="admin_messages.php" class="nav-link mx-3">Messages</a></li>
        </ul>
    </div>
</nav>