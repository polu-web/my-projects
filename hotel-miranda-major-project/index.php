<?php require('connection.php');
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"
        integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"
        integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">

    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Hotel Miranda Home Page</title>
</head>

<body>
    <header class="header <?php echo $isLoggedIn ? 'loggedIn' : ''; ?>">
        <div class="container">
            <nav class="nav">
                <a href="index.php">
                    <div class="logo nav__logo">
                        <div>H</div>
                        <span>HOTEL<br />MIRANDA</span>
                    </div>
                </a>
                <div class="login-bar">
                    <div class="nav-links header" id="navLinks">
                        <ul>
                            <li><a class="hoverPage" href="index.php">HOME</a></li>
                            <li><a href="rooms.php">ROOMS</a></li>
                            <li><a href="services.php">SERVICES</a></li>
                            <li><a href="gallery.php">GALLERY</a></li>
                            <li><a href="contact.php">CONTACT US</a></li>
                        </ul>
                    </div>
                    <div id="menu-icon" class="fa-solid fa-bars"></div>
                    <div class='sign-in-up'>

                        <?php if ($isLoggedIn): ?>
                            <button type='button' onclick="window.location.href='logout.php'">Logout</button>
                        <?php else: ?>
                            <a href="login.php">
                                Login
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="sign-in-up ">
                        <a class="admin-login" href="admin/admin_index.php">Admin</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section class="banner-section">
        <div id="intro-example" class="background_img text-center bg-image"
            style="background-image: url('img/hotel.png'); background-position: center; background-size:cover;">
            <div class="banner_inner mask">
                <div class=" d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <div class="text-box">
                            <h1>HOTEL MIRANDA</h1>
                            <p>
                                We offer a pocket friendly stay to each patron and
                                welcome them with complete warmth and hospitality.We take utmost care of the safety and
                                security of
                                individuals and their belongings staying in our hotel.
                            </p>
                            <a href="#testimonials" class="hero-btn">Visit us to know more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-sec-index">

        <div class="container">
            <div class="about-sec-video">
                <video autoplay loop muted plays-inline class="background-clip">
                    <source src="img/video.mp4" type="video/mp4">
                </video>
                <div class="content-1">
                    <p>ABOUT US</p>
                    <h2>Discover Our Underground</h2>
                    <p>Welcome to a hidden realm of extraordinary accommodations where luxury, comfort, and adventure
                        converge. Our underground hotels offer an unparalleled escape from the ordinary, inviting you to
                        explore a subterranean world of wonders.</p>
                    <a class="btn" href="#rooms">Book Now</a>
                </div>
            </div>
        </div>

    </section>



    <section class="services" style="padding:0">
        <div class="container">
            <h2>SERVICES</h2>
            <div class="portfolio-gallery scroll-bottom-left">
                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services1.jpg">
                    </div>
                    <div class="port-content">
                        <h3>Restaurant Service</h3>
                        <p>Hotels often include in-house restaurants that provide delicious meals and beverages to
                            guests. These services ensure a comfortable dining experience with options like room
                            service, buffet, and à la carte menus.
                        </p>

                    </div>
                </div>

                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services2.jpg">
                    </div>
                    <div class="port-content">
                        <h3>Free Wi-Fi</h3>
                        <p>Stay connected with our complimentary high-speed Wi-Fi available throughout the hotel.
                            Whether you're working, browsing, or streaming, enjoy seamless internet access during your
                            stay.
                        </p>

                    </div>
                </div>

                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services3.jpg">
                    </div>
                    <div class="port-content">
                        <h3>Swimming Pool</h3>
                        <p>Relax and unwind in our clean and well-maintained swimming pool. It's the perfect place to
                            refresh yourself, enjoy a swim, or simply lounge by the water after a busy day.
                        </p>
                    </div>
                </div>
            </div>
            <div class="service-btn-cls scroll-scale"><a href="services.php" class="service-btn">More Services</a></div>

        </div>
    </section>


    <section class="gallery">
        <div class="container">
            <h2>GALLERY</h2>
            <div class="row gallery-row">
                <div class="col-md-4 gallery-col">
                    <figure class="ag-photo-gallery_figure">
                        <a href="img/about-bg.jpg" data-fancybox="img">
                            <img src="img/about-bg.jpg" alt="" class="ag-photo-gallery_img">
                        </a>
                    </figure>
                </div>
                <div class="col-md-4 gallery-col">
                    <figure class="ag-photo-gallery_figure">
                        <a href="img/miranda-hotel.webp" data-fancybox="img">
                            <img src="img/miranda-hotel.webp" alt="" class="ag-photo-gallery_img">
                        </a>
                    </figure>
                </div>
                <div class="col-md-4 gallery-col">
                    <figure class="ag-photo-gallery_figure">
                        <a href="img/image-4.webp" data-fancybox="img">
                            <img src="img/image-4.webp" alt="" class="ag-photo-gallery_img">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <Section class="testimonials" id="testimonials">
        <div class="container">
            <h2>TESTIMONIALS</h2>
            <div class="row testimonial-row">
                <div class="col-md-4">
                    <figure class="testimonials-img">
                        <img src="img/news-3.jpg" alt="">
                    </figure>
                </div>
                <div class="col-md-8">
                    <div class="testimonial-slider">
                        <div class="testimonial-slide">
                            <h3><span><img src="img/quot.png"></span>Aditya Khosla</h3>
                            <p>I stayed in their hotel for almost 7 months and they provided excellent service.</p>
                        </div>
                        <div class="testimonial-slide">
                            <h3><span><img src="img/quot.png"></span>Nikita Pradhan</h3>
                            <p>The facilities they have in their hotel rooms are really good. You will feel like
                                you are at home.</p>
                        </div>
                        <div class="testimonial-slide">
                            <h3><span><img src="img/quot.png"></span>Taniya Banerjee</h3>
                            <p>Was really happy with their service while I was staying there. Would recommend others as
                                well.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </Section>


    <section>
        <div class="container">
            <div class="rooms" id="rooms">
                <h2 class="section__subheader">OUR ROOMS</h2>
                <div class="row room-wrap">
                    <div class="col-md-4 room-1 room__card">
                        <div class="card">
                            <img src="img/gallery3.png" class="card-img-top">
                            <a href="rooms.php" class="card-body">
                                <div class="room-left">
                                    <h5>Standard room</h5>
                                    <h6>
                                        ₹5000/<p>night</p>
                                    </h6>
                                </div>

                                <p>Well-appointed rooms designed for guests who desire a more.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 room-1 room__card">
                        <div class="card">
                            <img src="img/room-1.jpg" class="card-img-top">
                            <a href="rooms.php" class="card-body">
                                <div class="room-left">
                                    <h5>Luxury room</h5>
                                    <h6>
                                        ₹6500/<p>night</p>
                                    </h6>

                                </div>

                                <p>Consist of beautiful rooms and a common living area, with private balcony.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 room-1 room__card">
                        <div class="card">
                            <img src="img/image-4.webp" class="card-img-top">
                            <a href="rooms.php" class="card-body">
                                <div class="room-left">
                                    <h5>Deluxe room</h5>
                                    <h6>
                                        ₹8000/<p>night</p>
                                    </h6>

                                </div>
                                <p>Top-tier accommodations usually on the highest floors of a hotel.</p>

                            </a>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </section>



    <section class="contact" style="margin-top:100px;">
        <div class="container">
            <section class="contact-buttom">
                <h2>Contact With Us For Online Booking<br>Anywhere From The World</h2>
                <center><a href="contact.php" class="hero-btn">Contact us</a></center>
            </section>
        </div>
    </section>

    <section class="footer">
        <h4>follow Us</h4>
        <p>We offer a pocket friendly stay to each patron and welcome them with complete warmth and hospitality.We take
            utmost care of the safety and security of individuals and their belongings staying in our hotel.</p>
        <div class="icons">
            <div class="icon">
                <i class="fa fa-facebook"></i>
            </div>
            <div class="icon">
                <i class="fa fa-twitter"></i>
            </div>
            <div class="icon">
                <i class="fa fa-instagram"></i>
            </div>
            <div class="icon">
                <i class="fa fa-linkedin"></i>
            </div>
        </div>
    </section>
    <p class="p-foot"> © Copyright 2025 HOTEL MIRANDA. Terms & Privacy || Made With&nbsp;<i
            class="fa fa-heart-o"></i>&nbsp;miranda hotel</p>
    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none";
            }
            else {
                get_popup.style.display = "flex";
            }
        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>



    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="index.js"></script>
</body>

</html>