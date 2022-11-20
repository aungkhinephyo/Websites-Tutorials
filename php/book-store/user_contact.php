<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("Location: login.php");
}

if (isset($_POST['sendMessage'])) {
    // var_dump($_POST);
    // exit;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = $_POST['phone'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE user_id='$user_id' AND name='$name' AND email='$email' AND number='$phone' AND message='$message' ") or die('query failed');

    if (mysqli_num_rows($select_message) == 0) {
        mysqli_query($conn, "INSERT INTO `messages` (user_id,name,email,number,message) VALUES('$user_id','$name','$email','$phone','$message') ") or die('query failed!!');
    }

    $messages[] = "Message has been successfully sent.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
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
                <h1 class="text-danger text-uppercase">Contact</h1>
                <h4><a href="user_home.php" class="text-decoration-none text-warning">Home</a> / <a href="user_contact.php" class="text-decoration-none text-dark">Contact</a></h4>
            </div>
        </div>
    </section>
    <!------------------ end banner --------------------------->

    <!------------------ start contact form --------------------------->
    <section class="py-5">
        <div class="container">
            <div class="row p-2">
                <div class="col-lg-5 col-md-7 mx-auto p-3 border shadow-sm rounded-4" style="background: #eee;">
                    <form action="" method="POST">
                        <h4 class="text-center text-uppercase text-primary my-4">Send message to our team</h4>

                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required autofocus />
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Enter your email" required />
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Enter your phone" required />
                        </div>
                        <div class="form-group mb-3">
                            <textarea type="text" name="message" class="form-control" rows="5" placeholder="Message..." required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="sendMessage" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!------------------ end contact form --------------------------->


    <?php require_once "./layouts/footer.php"; ?>

    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- user js -->
    <script src="./js/user.js"></script>
</body>

</html>