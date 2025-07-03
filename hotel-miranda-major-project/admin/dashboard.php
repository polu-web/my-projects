<?php
require('db-config.php');
require('essentials.php');
adminLogin();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css" />
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="admin-style.css" />
    <title>Admin Panel-dashboard</title>

    <style>
        #toggleBtn {
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            outline: none;
            margin-left: 10px;
        }

        #toggleIcon {
            transition: transform 0.2s ease;
        }

        #adminDropdown {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container-fluid admin-dash-brd">
        <a href="index.php">
            <div class="logo nav__logo">
                <div>H</div>
                <span>HOTEL<br />MIRANDA</span>
            </div>
        </a>
        <a href="logout.php" class="logout-btn">LOG OUT</a>
    </div>

    <div class="row dash-wrap">
        <!-- Toggle Button -->
        <div class="col-md-2" id="dashboard-menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h4 class="mt-2 admin-panel">ADMIN PANEL</h4>

                        <!-- Unified Toggle Button Inside Sidebar -->
                        <button class="btn d-lg-none toggle-btn" onclick="toggleSidebar()" id="toggleBtn">
                            <i id="toggleIcon" class='bx bx-menu'></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse flex-column mt-2" id="adminDropdown">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link admin-hover" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="room-management.php">Rooms</a></li>
                            <li class="nav-item"><a class="nav-link" href="users-management.php">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="view-message.php">View Messages</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        <div class="container-fluid col-md-9" id="main-content">
            <div class="heading-dashboard">
                <h3>Dashboard</h3>
                <p>Summary of our hotel</p>
            </div>

            <div class="row">
                <div class="professional">
                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="90"></div>
                        <div class="text">
                            <big>90%</big>
                            <small>Positive Review</small>
                        </div>
                    </div>
                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="80"></div>
                        <div class="text">
                            <big>80%</big>
                            <small>Booking</small>
                        </div>
                    </div>
                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="75"></div>
                        <div class="text">
                            <big>75%</big>
                            <small>4+ Rating</small>
                        </div>
                    </div>
                    <div class="box">
                        <div class="circle" data-dots="80" data-percent="85"></div>
                        <div class="text">
                            <big>65%</big>
                            <small>Today's Booking</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="skill-main" id="bars">
                <div class="skill-left scroll-scale">
                    <h3>Our Activity Bars</h3>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Booked Rooms</p>
                            <p>77%</p>
                        </div>
                        <div class="bar">
                            <span class="booked"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Available Rooms</p>
                            <p>23%</p>
                        </div>
                        <div class="bar">
                            <span class="available"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Standard Rooms</p>
                            <p>69%</p>
                        </div>
                        <div class="bar">
                            <span class="standard"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Luxury Rooms</p>
                            <p>80%</p>
                        </div>
                        <div class="bar">
                            <span class="luxury"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Deluxe Room</p>
                            <p>73%</p>
                        </div>
                        <div class="bar">
                            <span class="deluxe"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Positive Reviews</p>
                            <p>85%</p>
                        </div>
                        <div class="bar">
                            <span class="positive-rev"></span>
                        </div>
                    </div>

                    <div class="skill-bar">
                        <div class="info">
                            <p>Negative Review</p>
                            <p>15%</p>
                        </div>
                        <div class="bar">
                            <span class="negative-rev"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminDropdown');
            const icon = document.getElementById('toggleIcon');

            // Toggle the sidebar visibility
            if (sidebar.classList.contains('show')) {
                sidebar.classList.remove('show'); 
                icon.className = 'bx bx-menu';    
            } else {
                sidebar.classList.add('show');    
                icon.className = 'fas fa-times';  
            }
        }
    </script>


    <script src="admin-index.js"></script>
</body>

</html>