<?php

require_once "./provider/connection.php";
session_start();


if (isset($_POST['submitbtn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $exist_user_sql = mysqli_query($conn, " SELECT * FROM users WHERE email='$email' AND password='$password' ");

    if (mysqli_num_rows($exist_user_sql) > 0) {

        $row = mysqli_fetch_assoc($exist_user_sql);

        if ($row['user_type'] == "admin") {

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header("Location:admin_page.php");
        } else if ($row['user_type'] == "user") {

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header("Location:user_home.php");
        }
    } else {

        $messages[] = 'Email or Passwrod is wrong';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
    <!-- login-register css -->
    <link rel="stylesheet" href="./css/intro.css" />
</head>

<body>

    <form action="" method="POST" class="p-5 intro-form">
        <h1 class="mb-4">LOGIN NOW</h1>

        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Enter your email" autofocus required />
        </div>
        <div class="form-group mb-3 password-box">
            <input type="password" name="password" class="form-control" placeholder="Enter your password" autocomplete="off" required />
            <i class="fas fa-eye showpassword"></i>
        </div>

        <div class="d-grid">
            <button type="submit" name="submitbtn" class="btn btn-success mb-3">Login Now</button>
        </div>

        <p>don't have an account? <a href="register.php" class="text-decoration-none text-primary">Register Now</a></p>

        <?php if (isset($messages)) : ?>
            <div class="alert alert-info text-center mb-3">
                <?php
                foreach ($messages as $message) {
                    echo $message . "<br>";
                }
                ?>
            </div>
        <?php endif ?>

    </form>




    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom js -->
    <script src="./js/intro.js"></script>
</body>

</html>