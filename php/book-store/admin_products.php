<?php

require_once "./provider/connection.php";
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("Location: login.php");
}

/* -----------------------------Start Add Product ------------------------------ */
if (isset($_POST['addbtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_path = 'uploaded_img/' . $image;

    $select_exist_product = mysqli_query($conn, "SELECT * FROM `products` WHERE name='$name'") or die('query failed');

    if (mysqli_num_rows($select_exist_product) > 0) {
        $messages[] = 'This product has already existed. Try another one.';
    } else {

        if ($image_size > 2000000) {
            $messages[] = 'Image size is too large.';
        } else {

            $add_product_query = mysqli_query($conn, "INSERT INTO `products` (name,price,image,image_path) VALUES ('$name','$price','$image','$image_path')") or die('query failed');

            if ($add_product_query) {

                if (file_exists("./uploaded_img")) {
                    move_uploaded_file($image_tmp_name, $image_path);
                } else {
                    mkdir("./uploaded_img");
                    move_uploaded_file($image_tmp_name, $image_path);
                }
                $messages[] = 'This product is successfully added.';
            }
        }
    }
}
/* -----------------------------End Add Product ------------------------------ */

/* -----------------------------Start Update Product ------------------------------ */
if (isset($_POST['updatebtn'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name='$update_name',price='$update_price' WHERE id='$update_id'") or die('query failed');

    $update_old_image = $_POST['update_old_image'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_path = "uploaded_img/" . $update_image;

    if (!empty($update_image)) {

        if ($update_image_size > 2000000) {
            $file_size_error = 'Image size is too large.';
        } else {

            mysqli_query($conn, "UPDATE `products` SET image='$update_image',image_path='$update_image_path' WHERE id='$update_id'") or die('query failed');

            move_uploaded_file($image_tmp_name, $image_path);
            unlink('uploaded_img/' . $update_old_image);
            $messages[] = 'This product is successfully updated.';
        }
    } else {
        $messages[] = 'This product is successfully updated.';
    }
    header("Location: admin_products.php");
}
/* -----------------------------End Update Product ------------------------------ */

/* -----------------------------Start Delete Product ------------------------------ */
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_image_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$delete_id'") or die('query failed');
    $fetch_delete_product = mysqli_fetch_assoc($delete_image_query);
    unlink($fetch_delete_product['image_path']);

    mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id' ") or die('query failed');

    header("Location: admin_products.php");
}
/* -----------------------------End Delete Product ------------------------------ */

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

    <!-- custom admin css -->
    <link rel='stylesheet' href="./css/admin.css" type="text/css" />
</head>

<body class="bg-secondary">
    <?php require_once("./layouts/admin_header.php"); ?>

    <!--------------start add product ---------->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-10 mx-auto p-3">
                    <div class="p-5 border rounded-4 shadow bg-light">

                        <h2 class="text-success  text-center mb-4">ADD PRODUCT</h2>

                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Enter product name" required />
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" name="price" class="form-control" placeholder="Enter product price" min="0" step="0.01" required />
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" required />
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-success w-50" name="addbtn">Add Product</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------end add product -------------->

    <!--------- start show products ------------->
    <section class="py-5">
        <div class="container-fluid">
            <h2 class="text-center text-warning mb-5">PRODUCTS</h2>
            <div class="row">

                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');

                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-8 mx-auto p-3">
                            <div class="h-100 text-center py-4 bg-light rounded-3 shadow">
                                <img src="<?php echo $fetch_products['image_path'] ?>" width="60%" class="img-thumbnail" />

                                <p><?php echo $fetch_products['name']; ?></p>
                                <p>$<?php echo $fetch_products['price']; ?>/-</p>

                                <div class="text-center mt-4">
                                    <a href="admin_products.php?update=<?php echo $fetch_products['id'] ?>" class="btn btn-warning">Update</a>

                                    <a href="admin_products.php?delete=<?php echo $fetch_products['id'] ?>" class="btn btn-danger" onclick="confirm('Are you sure to delete this product?');">Delete</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="alert alert-info text-center my-5">There is no products added to show now!!</p>';
                }
                ?>

            </div>
        </div>
    </section>
    <!---------- end show products -------------->

    <!------ start update modal  ------------->
    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$update_id' ") or die('query failed');

        if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update_product = mysqli_fetch_assoc($update_query)) {

    ?>
                <div class="update_modal_bg">
                    <div class="update_modal">

                        <button type="button" class="btn-close btn_close_modal"></button>

                        <div class="modal-body">

                            <h2 class="text-success text-center mb-4">UPDATE PRODUCT</h2>

                            <img src="<?php echo $fetch_update_product['image_path']; ?>" width="150px" class="img-thumbnail mb-3" />

                            <form action="" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="update_id" value="<?php echo $fetch_update_product['id']; ?>" />

                                <input type="hidden" name="update_old_image" value="<?php echo $fetch_update_product['image']; ?>" />

                                <div class="form-group mb-3">
                                    <input type="text" name="update_name" class="form-control" placeholder="Enter product name" value="<?php echo $fetch_update_product['name']; ?>" required />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="number" name="update_price" class="form-control" placeholder="Enter product price" min="0" step="0.01" value="<?php echo $fetch_update_product['price']; ?>" required />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="file" name="update_image" class="form-control" accept="image/jpg, image/jpeg, image/png" />
                                </div>
                                <?php if (isset($file_size_error)) : ?>
                                    <span class="text-danger mb-3">
                                        <?php echo "*" . $file_size_error; ?>
                                    </span>
                                <?php endif ?>
                                <div>
                                    <button type="submit" class="btn btn-primary mx-3 update_btn" name="updatebtn">Update Product</button>

                                    <button type="button" class="btn btn-warning mx-3 w-25 cancel_btn">Cancel</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

    <?php
            }
        }
    }
    ?>
    <!------ end update modal  ------------->


    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom admin js -->
    <script src="./js/admin.js"></script>
</body>

</html>