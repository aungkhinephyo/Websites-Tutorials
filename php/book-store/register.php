<?php

require_once "./provider/connection.php";


if (isset($_POST['submitbtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $user_type = $_POST['user_type'];

    $exist_user_sql = mysqli_query($conn, " SELECT * FROM users WHERE email='$email' ");


    if (mysqli_num_rows($exist_user_sql) > 0) {

        $messages[] = 'This email address is already used.';
    } else {

        if ($password !== $c_password) {

            $messages[] = 'The two passwords are not matched.';
        } else {

            $sql = "INSERT INTO users (name,email,password,user_type) 
                    VALUES ('$name','$email','$password','$user_type')";
            $query = mysqli_query($conn, $sql) or die('Register failed');

            $messages[] = 'Register success!!';
            header("Location: login.php");
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
    <title>Register Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
    <!-- login-register css -->
    <link rel="stylesheet" href="./css/intro.css" />
</head>

<body>

    <form action="" method="POST" class="p-5 intro-form">
        <h1 class="mb-4">REGISTER NOW</h1>

        <div class="form-group mb-3">
            <input type="name" name="name" class="form-control" placeholder="Enter your name" autocomplete="off" autofocus required />
        </div>
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Enter your email" autocomplete="off" required />
        </div>
        <div class="form-group mb-3 password-box">
            <input type="password" name="password" class="form-control" placeholder="Enter your password" autocomplete="off" required />
            <i class="fas fa-eye showpassword"></i>
        </div>
        <div class="form-group mb-3 password-box">
            <input type="password" name="c_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required />
            <i class="fas fa-eye showpassword"></i>
        </div>
        <div class="form-group mb-3">
            <select name="user_type" class="form-select">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
        </div>

        <div>
            <button type="submit" name="submitbtn" class="btn btn-primary w-50 mb-3">Register Now</button>
        </div>

        <p>Already have an account? <a href="login.php" class="text-decoration-none text-primary">Login Now</a></p>

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