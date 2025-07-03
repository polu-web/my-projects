<?php
require('../connection.php'); // Adjusted path to connection
session_start();

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM `message-box` WHERE id = $delete_id";
    mysqli_query($con, $delete_query);
    header("Location: view-message.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin - View Messages</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css" />
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="admin-style.css" />

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

        td a {
            display: flex;
            align-items: center;
        }

        td a i {
            padding-right: 10px;
        }

        @media(max-width: 576px) {
            .table-responsive {
                font-size: 0.85rem;
            }
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

    <div class="row dash-wrap dash-wrap1">
        <!-- Sidebar -->
        <div class="col-md-2" id="dashboard-menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h4 class="mt-2 admin-panel">ADMIN PANEL</h4>

                        <!-- Toggle Button -->
                        <button class="btn d-lg-none toggle-btn" onclick="toggleSidebar()" id="toggleBtn">
                            <i id="toggleIcon" class='bx bx-menu'></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse flex-column mt-2" id="adminDropdown">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="room-management.php">Rooms</a></li>
                            <li class="nav-item"><a class="nav-link" href="users-management.php">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                            <li class="nav-item"><a class="nav-link admin-hover" href="view-message.php">View
                                    Messages</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 container" id="main-content">
            <h2 class="mb-4 update-con-dtl">User Messages</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM `message-box` ORDER BY id DESC");
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$i}</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['phno']) . "</td>
                                    <td>" . htmlspecialchars($row['msg']) . "</td>
                                    <td>
                                        <a href='view-message.php?delete_id={$row['id']}'
                                           onclick='return confirm(\"Are you sure to delete this message?\")'>
                                           <i class='fas fa-trash-alt'></i> Delete
                                        
                                   </a>
                                    </td>
                                  </tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No messages found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminDropdown');
            const icon = document.getElementById('toggleIcon');

            if (sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                icon.className = 'bx bx-menu';
            } else {
                sidebar.classList.add('show');
                icon.className = 'fas fa-times';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="admin-index.js"></script>
</body>

</html>