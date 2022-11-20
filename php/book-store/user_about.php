<?php

require_once "./provider/connection.php";
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User About Page</title>
    <!-- fontawesome css 1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- bootstrap css 1 js 1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

    <!-- custom admin css -->
    <link rel='stylesheet' href="./css/user.css" type="text/css" />
</head>

<body>

    <?php require_once "./layouts/header.php"; ?>

    <!-------------------- start banner ----------------------->
    <section id="about_banner">
        <div class="container">
            <div class="text-center w-50 mx-auto">
                <h1 class="text-danger">About Us</h1>
                <h4><a href="home.php" class="text-decoration-none text-warning">Home</a> / <a href="about.php" class="text-decoration-none text-dark">About</a></h4>
            </div>
        </div>
    </section>
    <!-------------------- end banner ----------------------->

    <!-------------------- start bannen2 ----------------------->
    <section class="py-5">
        <div class="container">
            <div class="row bg-light">
                <div class="col-lg-6 mb-3">
                    <img src="./images/about-img.jpg" width="100%" />
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center text-center text-md-start p-3">
                    <h1 class="text-danger mb-4">Why Choose Us?</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia, voluptates totam! Laboriosam nam magni molestias adipisci labore voluptates libero voluptas officiis sapiente, sit numquam, eveniet praesentium ad sunt dolorum quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit deleniti exercitationem itaque cumque enim molestias consectetur a, facere necessitatibus voluptatem.</p>
                    <div>
                        <a href="user_contact.php" class="btn btn-lg btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-------------------- end bannen2 ----------------------->

    <!-------------------- start reviews ----------------------->
    <section id="reviews" class="py-5 bg-dark">
        <div class="container">
            <h1 class="text-center text-danger">Testimonials</h1>

            <div id="mycarousel" class="carousel slide" data-bs-ride="carousel">

                <ol class="carousel-indicators">
                    <li class="active" data-bs-target="#mycarousel" data-bs-slide-to="0"></li>
                    <li data-bs-target="#mycarousel" data-bs-slide-to="1"></li>
                    <li data-bs-target="#mycarousel" data-bs-slide-to="2"></li>
                    <li data-bs-target="#mycarousel" data-bs-slide-to="3"></li>
                    <li data-bs-target="#mycarousel" data-bs-slide-to="4"></li>
                    <li data-bs-target="#mycarousel" data-bs-slide-to="5"></li>
                </ol>

                <div class="carousel-inner py-5">

                    <div class="row carousel-item active">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-1.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">Mathew</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                    <div class="row carousel-item">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-2.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">Nora Jone</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                    <div class="row carousel-item">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-3.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">Jonathan</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                    <div class="row carousel-item">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-4.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">Seria Mully</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                    <div class="row carousel-item">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-5.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">John Paul</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                    <div class="row carousel-item">
                        <div class="col-md-6 text-center text-light mx-auto">
                            <img src="./images/pic-6.png" alt="customer_img" width="100px" class="img-thumbnail rounded-circle" />
                            <h5 class="text-info my-3">Monica Starli</h5>
                            <p>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem adipisci dicta inventore pariatur laborum dolor quae tempore voluptates fugiat tenetur?</p>
                        </div>
                    </div>

                </div>

                <a href="#mycarousel" class="carousel-control-prev" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"></span>
                </a>
                <a href="#mycarousel" class="carousel-control-next" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"></span>
                </a>

            </div>

        </div>
    </section>
    <!-------------------- end reviews ----------------------->

    <!-------------------- start authors ----------------------->
    <section id="authors" class="py-5">
        <h1 class="text-center text-danger mb-5">Famous Authors</h1>
        <div class="container">
            <div class="row py-3">

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-1.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-2.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-3.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-4.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-5.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/author-6.jpg" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/pic-1.png" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 mb-3 author">
                    <div class="author_info">
                        <img src="./images/pic-4.png" alt="author" width="100%" />
                        <h4 class="my-4">Jonathan</h4>
                        <p class="fs-5 m-0">Popular Author</p>

                        <div class="author_socials">
                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </section>
    <!-------------------- end authors ----------------------->




    <?php require_once "./layouts/footer.php"; ?>

    <!-- bootstrap css 1 js 1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- user js -->
    <script src="./js/user.js"></script>
</body>

</html>