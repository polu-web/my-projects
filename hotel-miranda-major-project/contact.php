<?php require('connection.php');
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];

// Include the necessary files for DB connection
require('admin/db-config.php');
require('admin/essentials.php');

// Fetch the current contact details to display on the form
$q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$datatypes = 'i';
$res = select($q, $values, $datatypes);
$data = mysqli_fetch_assoc($res); // Fetch the data
if (!$data) {
    die("No data found for contact details."); // If no data is fetched, show an error message
}
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
    <title>STUDENT hotel MANAGEMENT</title>
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
                            <li><a href="services.php">SERVICES</a></li>
                            <li><a href="gallery.php">GALLERY</a></li>
                            <li><a class="hoverPage" href="contact.php">CONTACT US</a></li>
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
                            <h1>CONTACT US</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact">

        <section class="location">
            <h3>Location</h3>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7687.282989695376!2d73.74681226977538!3d15.55733790000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfebf4892baeb9%3A0x544cbb011834ff11!2sMiranda%20Beach%20Resort!5e0!3m2!1sen!2sin!4v1745931865527!5m2!1sen!2sin"
                width="" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <section class="contact-pg">
            <div class="container">
                <div class="contact-wrap">
                    <h3>Contact Details</h3>
                    <div class="row connect">
                        <!-- Address Section -->
                        <div class="col-md-3 connet-item">
                            <center>
                                <span><img src="img/location.png" alt="Location"></span>
                                <h4>Our Address</h4>
                                <a href="<?php echo urlencode($data['address']); ?>"
                                    target="_blank">
                                    <?php echo htmlspecialchars($data['address']); ?>
                                </a>
                            </center>
                        </div>
                        <!-- Contact Us Section -->
                        <div class="col-md-3 connet-item">
                            <center>
                                <span><img src="img/call.png" alt="Call"></span>
                                <h4>Contact Us</h4>
                                <a
                                    href="tel:+<?php echo htmlspecialchars($data['pn1']); ?>"><?php echo htmlspecialchars($data['pn1']); ?></a>
                            </center>
                        </div>
                        <!-- E-mail Section -->
                        <div class="col-md-3 connet-item">
                            <center>
                                <span><img src="img/email.png" alt="Email"></span>
                                <h4>E-mail us your query</h4>
                                <a
                                    href="mailto:<?php echo htmlspecialchars($data['email']); ?>"><?php echo htmlspecialchars($data['email']); ?></a>
                            </center>
                        </div>
                        <!-- Timings Section -->
                        <div class="col-md-3 connet-item">
                            <center>
                                <span><img src="img/time.png" alt="Time"></span>
                                <h4>Our timings</h4>
                                <p>Mon-Sun: 10:00AM - 8:00PM</p>
                            </center>
                        </div>
                    </div>
                </div>


                <div class="message">
                    <form action="form_handeler.php" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" size="44" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-4">
                                <input type="email" size="44" name="email" placeholder=" E-mail Address" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" size="44" name="phno" placeholder="Mobile Number" required>
                            </div>
                        </div>
                        <center>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea rows="5" size="300" name="msg" placeholder="Message" required></textarea>
                                </div>
                            </div>
                        </center>

                        <center><button type="submit" class="hero-btn">Submit</button></center>
                    </form>
                </div>
            </div>
            </div>
        </section>

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

    <!-- <script>
        $(document).ready(function () {
            // Fetch current contact details and populate the contact section
            $.post('setting-crud.php', { get_contacts: true }, function (response) {
                const data = JSON.parse(response);
                // Update HTML content with the fetched values
                $('a[href*="maps.app.goo.gl"]').text(data.address).attr('href', data.gmap);
                $('a[href^="tel:"]').text(data.pn1).attr('href', 'tel:' + data.pn1);
                $('a[href^="mailto:"]').text(data.email).attr('href', 'mailto:' + data.email);
            });

            // Submit the updated contact details
            $('#contact-form').submit(function (e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.post('setting-crud.php', formData + '&upd_contacts=true', function (response) {
                    if (response == 1) {
                        alert('Contact details updated successfully!');
                    } else {
                        alert('Failed to update contact details!');
                    }
                });
            });
        });

    </script> -->

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