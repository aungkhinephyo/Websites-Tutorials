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
    mysqli_query($conn, "DELETE FROM `messages` WHERE id='$delete_id' ") or die('query failed');
    header("Location: admin_messages.php");
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

    <h1 class="text-warning text-center mt-5">Messages</h1>

    <section class="py-5">
        <div class="container">
            <div class="row">

                <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                while ($fetch_message = mysqli_fetch_assoc($select_messages)) {
                ?>
                    <div class="col-lg-6 col-12 p-3">
                        <div class="h-100 p-3 rounded-3 shadow bg-light">
                            <p class="fw-bold">User ID: <span class="text-muted"><?php echo $fetch_message['user_id']; ?></span></p>
                            <p class="fw-bold">Username: <span class="text-muted"><?php echo $fetch_message['name']; ?></span></p>
                            <p class="fw-bold">Email: <span class="text-muted"><?php echo $fetch_message['email']; ?></span></p>
                            <p class="fw-bold">Number: <span class="text-muted"><?php echo $fetch_message['number']; ?></span></p>

                            <input type="hidden" value="<?php echo $fetch_message['message']; ?>" class="message_hidden">
                            <p class="text-light p-3 rounded-2 border message-box">
                                <span class="message"></span>
                                <a href="admin_messages.php?show=<?php echo $fetch_message['id']; ?>">Read Details</a>
                            </p>

                            <div>
                                <a href="admin_messages.php?delete=<?php echo $fetch_message['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this account');">Delete Message</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>

    <!--start show message details -->
    <?php
    if (isset($_GET['show'])) {
        $message_id = $_GET['show'];
        $message_query = mysqli_query($conn, "SELECT * FROM `messages` WHERE id='$message_id' ") or die('query failed');
        if (mysqli_num_rows($message_query) > 0) {
            while ($fetch_show_message = mysqli_fetch_assoc($message_query)) {
    ?>
                <div class="message_modal_bg">
                    <div class="message_modal">
                        <button type="button" class="btn-close btn_close_message"></button>
                        <p>
                            <?php echo $fetch_show_message['message']; ?>
                        </p>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>

    <!--end show message details -->


    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom admin js -->
    <script src="./js/admin.js"></script>
</body>

</html>