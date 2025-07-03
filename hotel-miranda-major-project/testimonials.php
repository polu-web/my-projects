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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <title></title>
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
                <div class="nav-links" id="navLinks">
                    <ul>
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="rooms.php">ROOMS</a></li>
                        <li><a href="services.php">SERVICES</a></li>
                        <li><a href="gallery.php">GALLERY</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
                    </ul>
                </div>

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
                            <h1>TESTIMONIALS</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <Section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <figure>
                        <img src="img/testimonials.png" alt="">
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
    </Section>
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
    <p class="p-foot"> © Copyright 2025 HOTEL MIRANDA. Terms & Privacy || Made With&nbsp;<i class="fa fa-heart-o"></i>&nbsp;miranda hotel</p>
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