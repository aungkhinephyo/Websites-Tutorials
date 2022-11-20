<?php

require_once "./provider/connection.php";
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("Location: login.php");
}
/* ------------------start remove order ------------------------ */
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id='$delete_id' ") or die('query failed');
    header("Location: admin_users.php");
}
/* ------------------end remove order ------------------------ */


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

    <section>
        <div class="container">
            <div class="row py-5">
                <h2 class="text-warning text-center mb-5">Normal Users</h2>

                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='user' ") or die('query failed');
                while ($fetch_user = mysqli_fetch_assoc($select_users)) {
                ?>
                    <div class="col-lg-3 col-sm-6 col-12 p-3 h-100">
                        <div class="p-3 rounded-3 shadow bg-light h-100">
                            <p class="fw-bold">User ID in db: <span class="text-primary"><?php echo $fetch_user['id']; ?></span></p>
                            <p class="fw-bold">Username: <span class="text-primary"><?php echo $fetch_user['name']; ?></span></p>
                            <p class="fw-bold">Email: <span class="text-primary"><?php echo $fetch_user['email']; ?></span></p>
                            <p class="fw-bold">Password: <span class="text-primary"><?php echo $fetch_user['password']; ?></span></p>
                            <p class="fw-bold">Type: <span class="text-primary"><?php echo $fetch_user['user_type']; ?></span></p>

                            <a href="admin_users.php?delete=<?php echo $fetch_user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this account');">Delete Account</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            <hr class="border-white">

            <div class="row py-5">

                <h2 class="text-warning text-center mb-5">Admins</h2>

                <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='admin' ") or die('query failed');
                while ($fetch_admin = mysqli_fetch_assoc($select_admins)) {
                ?>
                    <div class="col-lg-3 col-sm-6 col-12 p-3 h-100">
                        <div class="p-3 rounded-3 shadow bg-light h-100">
                            <p class="fw-bold">User ID in db: <span class="text-primary"><?php echo $fetch_admin['id']; ?></span></p>
                            <p class="fw-bold">Username: <span class="text-primary"><?php echo $fetch_admin['name']; ?></span></p>
                            <p class="fw-bold">Email: <span class="text-primary"><?php echo $fetch_admin['email']; ?></span></p>
                            <p class="fw-bold">Password: <span class="text-primary"><?php echo $fetch_admin['password']; ?></span></p>
                            <p class="fw-bold">Type: <span class="text-primary"><?php echo $fetch_admin['user_type']; ?></span></p>

                            <a href="admin_users.php?delete=<?php echo $fetch_admin['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this account');">Delete Account</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>


    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom admin js -->
    <script src="./js/admin.js"></script>
</body>

</html>