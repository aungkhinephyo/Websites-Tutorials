<?php

    require_once "./provider/connection.php";
    session_start();
    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header("Location: login.php");
    }

    /* ------------------start approve order ------------------------ */
    if (isset($_POST['approvebtn'])) {
        $order_approve_id = $_POST['order_approve_id'];
        $payment_approve_status = $_POST['payment_approve_status'];
        
        $select_order_approve = mysqli_query($conn, "SELECT * FROM `orders` WHERE id='$order_approve_id' ") or die('query failed');
        $fetch_order_approve = mysqli_fetch_assoc($select_order_approve);

        mysqli_query($conn, "UPDATE `orders` SET payment_status='$payment_approve_status' WHERE id='$order_approve_id' ") or die('query failed');

        if($fetch_order_approve['payment_status'] == 'completed'){

            $messages[] = 'This order has been already completed. But you change the status to "pending".';
            
        }else {

            $messages[] = 'This order is successfully approved. Payment is completed.';
         
        }
        
    }
    /* ------------------end approve order ------------------------ */


    /* ------------------start remove order ------------------------ */
    if(isset($_GET['delete'])){
        $order_delete_id = $_GET['delete'];
        $select_order_delete = mysqli_query($conn,"SELECT * FROM `orders` WHERE id='$order_delete_id' ") or die('query failed');
        $fetch_delete_order = mysqli_fetch_assoc($select_order_delete);

        if($fetch_delete_order['payment_status'] == 'completed'){
            mysqli_query($conn, "DELETE FROM `orders` WHERE id='$order_delete_id' ") or die('query failed');
            header("Location: admin_orders.php");
        }else{
            $messages[] = 'Payment is not completed. You need to approve that it is completed first.';
        }

    }
    /* ------------------end remove order ------------------------ */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />

    <!-- custom admin css -->
    <link rel='stylesheet' href="./css/admin.css" type="text/css" />
</head>

<body class="bg-secondary">
    <?php require_once("./layouts/admin_header.php"); ?>

    <h1 class="text-center text-warning mt-5">Dealing Orders</h1>

    <section>
        <div class="container">
            <div class="row py-5">

                <!----------------------- start show orders ----------------------->
                <?php
                $select_orders_query = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                if (mysqli_num_rows($select_orders_query) > 0) {

                    while ($fetch_order = mysqli_fetch_assoc($select_orders_query)) {
                ?>

                        <!--------------- start orders --------------->
                        <div class="col-lg-4 col-sm-6 col-12 p-3">
                            <div class="h-100 p-3 rounded-3 shadow <?php 
                            if($fetch_order['payment_status'] == 'completed') echo 'bg-warning'; else echo "bg-light"; ?>">

                                <p class="fw-bold">User ID : <span class="text-danger"><?php echo $fetch_order['user_id']; ?></span></p>
                                <p class="fw-bold">Name : <span class="text-danger"><?php echo $fetch_order['name']; ?></span></p>
                                <p class="fw-bold">Email : <span class="text-danger"><?php echo $fetch_order['email']; ?></span></p>
                                <p class="fw-bold">Phone Number : <span class="text-danger"><?php echo $fetch_order['number']; ?></span></p>
                                <p class="fw-bold">Placed on : <span class="text-danger"><?php echo $fetch_order['placed_on']; ?></span></p>
                                <p class="fw-bold">Total Products : <span class="text-danger"><?php echo $fetch_order['total_products']; ?></span></p>
                                <p class="fw-bold">Total Price : <span class="text-danger">$<?php echo $fetch_order['total_price']; ?>/-</span></p>
                                <p class="fw-bold">Address : <span class="text-danger"><?php echo $fetch_order['address']; ?></span></p>
                                <p class="fw-bold">Payment Method : <span class="text-danger"><?php echo $fetch_order['method']; ?></span></p>

                                <form action="" method="POST">
                                    <input type="hidden" name="order_approve_id" value="<?php echo $fetch_order['id']; ?>">

                                    <div class="form-group mb-4">
                                        <select name="payment_approve_status" class="form-select" required>
                                            <option value="" selected disabled><?php echo $fetch_order['payment_status']; ?></option>
                                            <option value="pending">pending</option>
                                            <option value="completed">completed</option>
                                        </select>
                                    </div>

                                    <div class="action text-center">
                                        <button type="submit" class="btn btn-success me-3 w-25" name="approvebtn">Approve</button>

                                        <a href="admin_orders.php?delete=<?php echo $fetch_order['id'] ?>" class="btn btn-danger w-25" onclick="return confirm('Are you sure it is completed?');">Delete</a>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <!--------------- end orders --------------->

                <?php
                    }
                } else {
                    echo '<p class="alert alert-info text-center my-5">There is no order now.</p>';
                }

                ?>

                <!----------------------- end show orders ----------------------->

            </div>
        </div>
    </section>


    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom admin js -->
    <script src="./js/admin.js"></script>
</body>

</html>