<?php

require('connection.php');
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
include('admin/db-config.php');
$result = $con->query("SELECT * FROM rooms");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">

    <title>Hotel Miranda Rooms</title>
    <style>
        .room-card {
            background: #e3e9f2;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .room-card img {
            border-radius: 12px;
            max-height: 260px;
            width: 100%;
            object-fit: cover;
        }

        .feature-badge {
            background: #c3b4c9;
            margin: 2px;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            color: #050165;
            font-weight: 600;
        }

        .text-primary1 {
            color: yellowgreen;
        }
    </style>
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
                        <li><a class="hoverPage" href="rooms.php">ROOMS</a></li>
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
                        <a href="login.php">Login</a>
                    <?php endif; ?>
                </div>
                <div class="sign-in-up">
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
                        <h1>OUR ROOMS</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <h2 class="mb-4">Available Rooms</h2>
    <?php while ($room = $result->fetch_assoc()): ?>
        <div class="room-card d-flex">
            <img src="<?= 'admin/' . htmlspecialchars($room['image']) ?>" alt="Room" class="img-thumbnail">
            <div class="col-md-7 ps-4">
                <h3 class="text-warning fw-bold"><?= htmlspecialchars($room['name']) ?></h3>
                <p class="fw-bold text-primary1 fs-5">Features</p>
                <?php foreach (explode(",", $room['features']) as $feature): ?>
                    <span class="feature-badge"><?= trim($feature) ?></span>
                <?php endforeach; ?>
                <p class="fw-bold text-primary1 fs-5 mt-3">Rating</p>
                <p>
                    <?php for ($i = 0; $i < $room['rating']; $i++): ?>
                        <span style="color: gold;">⭐</span>
                    <?php endfor; ?>
                </p>
                <h5 class="mt-2 price">₹<?= $room['price'] ?>/night</h5>

                <button class="btn btn-warning">
                    <a href="room-book.php?room_id=<?= $room['id'] ?>" class=" text-decoration-none">Book Now</a>
                </button>
            </div>
        </div>
    <?php endwhile; ?>
</div>

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
            class="fa fa-heart-o"></i>&nbsp;miranda hotel
    </p>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking popup">
                        <form method="POST" action="rooms.php">
                            <input type="text" placeholder="Full Name" name="fullname" required>
                            <button type="submit" class="register-btn" name="booking">REGISTER</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

 

    <!-- Add some styles to make the feature badges look nicer -->
    <style>
        .feature-badge {
            margin-right: 5px;
            padding: 5px 10px;
            font-size: 14px;
            display: inline-block;
        }
    </style>




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