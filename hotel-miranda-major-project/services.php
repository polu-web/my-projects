<?php require('connection.php');
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <title>Hotel Miranda Services</title>
</head>

<body>
    <header class="header <?php echo $isLoggedIn ? 'loggedIn' : ''; ?>">
        <div class="container">
            <nav>
                <a href="index.php">
                    <div class="logo nav__logo">
                        <div>H</div>
                        <span>HOTEL<br />MIRANDA</span>
                    </div>
                </a>
                <div class="login-bar">
                    <div class="nav-links" id="navLinks">
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="rooms.php">ROOMS</a></li>
                            <li><a class="hoverPage" href="services.php">SERVICES</a></li>
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
                                <!-- <button type='button' onclick="popup('login-popup')">LOGIN</button> -->

                            </a>
                        <?php endif; ?>

                        <!-- <button type='button' onclick="popup('register-popup')">REGISTER</button> -->
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
                        <div class="text-box1">
                            <h1>SERVICES WE PROVIDE</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services service">
        <div class="container">
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

                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services4.jpg">
                    </div>
                    <div class="port-content">
                        <h3>Room Cleaning</h3>
                        <p>We offer daily room cleaning to keep your space fresh and tidy. Our housekeeping staff
                            ensures your room is spotless and comfortable throughout your stay.
                        </p>
                    </div>
                </div>

                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services5.jpg">
                    </div>
                    <div class="port-content">
                        <h3>Room Service</h3>
                        <p>
                            Enjoy delicious meals and snacks in the comfort of your room with our quick and efficient
                            room service. Just place an order, and we’ll deliver right to your door.
                        </p>

                    </div>
                </div>

                <div class="port-box">
                    <div class="port-img">
                        <img src="img/services6.png">
                    </div>
                    <div class="port-content">
                        <h3>Dry Cleaning</h3>
                        <p>Take advantage of our reliable dry cleaning service to keep your clothes clean and
                            wrinkle-free. It's ideal for guests who are traveling for business or special events.
                        </p>
                    </div>
                </div>


            </div>

        </div>
    </section>
    <section class="service-video">
        <figure class="houwzerPlay"><img id="thumbnail" src="img/service.thumbnail.webp" class="thumbnail">
            <button class="play-button play-btn" id="playBtn">
                <img src="img/play.png"></button>
        </figure>
        <video id="video" controls>
            <source src="img/service-video.mp4" type="video/mp4">
        </video>
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

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="index.js"></script>
</body>

</html>