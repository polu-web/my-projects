<?php
// Include the connection file
require('../connection.php');

// Ensure only admin has access
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location:admin_index.php'); // Redirect to login page if not logged in as admin
//     exit;
// }

// Check if delete request is made
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    // Sanitize user input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $user_id);

    // SQL query to delete the user
    $delete_query = "DELETE FROM registered_users WHERE email = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, 's', $user_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the users management page after deletion
        header('Location: users-management.php');
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

// Fetch all users from the registered_users table
$query = "SELECT full_name, username, email, phNo, dob FROM registered_users";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
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
        <!-- Toggle Button -->
        <div class="col-md-2" id="dashboard-menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h4 class="mt-2 admin-panel">ADMIN PANEL</h4>

                        <button class="btn d-lg-none toggle-btn" onclick="toggleSidebar()" id="toggleBtn">
                            <i id="toggleIcon" class='bx bx-menu'></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse flex-column mt-2" id="adminDropdown">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="room-management.php">Rooms</a></li>
                            <li class="nav-item"><a class="nav-link admin-hover" href="users-management.php">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                             <li class="nav-item"><a class="nav-link" href="view-message.php">View Messages</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        <div class="col-md-9 container" id="main-content">
            <h2 class="update-con-dtl">Login User Details</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Date of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['full_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phNo'] . "</td>";
                            echo "<td>" . $row['dob'] . "</td>";
                            echo "<td><a href='users-management.php?delete=" . $row['email'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </table>
        </div>

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

<?php
// Close the database connection
mysqli_close($con);
?>