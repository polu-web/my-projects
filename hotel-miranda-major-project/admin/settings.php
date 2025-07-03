<?php
require('db-config.php'); // Include your database connection
require('essentials.php'); // If you have any additional helpers

// Fetch existing contact details
$q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
$values = [1];  // Assuming sr_no = 1 to fetch the first row
$datatypes = 'i'; // Integer type for sr_no

$res = select($q, $values, $datatypes);
$data = mysqli_fetch_assoc($res); // Fetch the data as an associative array

if (!$data) {
    die("No data found for contact details.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update data when the form is submitted
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pn1 = $_POST['pn1'];

    // SQL query to update the contact details
    $updateQuery = "UPDATE `contact_details` SET `address` = ?, `email` = ?, `pn1` = ? WHERE `sr_no` = ?";
    $values = [$address, $email, $pn1, 1]; // Set sr_no to 1 to update the first row
    $datatypes = 'sssi'; // 's' for string, 'i' for integer

    $result = update($updateQuery, $values, $datatypes);

    if ($result) {
        echo "<script>alert('Contact details updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update contact details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact Details</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css" />
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="admin-style.css" />
    <style>
        /* Styling the toggle button inside the sidebar */
        #toggleBtn {
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            outline: none;
            margin-left: 10px;
            /* Adjust the position if needed */
        }

        #toggleIcon {
            transition: transform 0.2s ease;
        }

        /* Optional: when the sidebar is collapsed, this can be hidden or adjusted */
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

                        <!-- Unified Toggle Button Inside Sidebar -->
                        <button class="btn d-lg-none toggle-btn" onclick="toggleSidebar()" id="toggleBtn">
                            <i id="toggleIcon" class='bx bx-menu'></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse flex-column mt-2" id="adminDropdown">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="room-management.php">Rooms</a></li>
                            <li class="nav-item"><a class="nav-link" href="users-management.php">Users</a></li>
                            <li class="nav-item"><a class="nav-link admin-hover" href="settings.php">Settings</a></li>
                             <li class="nav-item"><a class="nav-link" href="view-message.php">View Messages</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-md-9 container" id="main-content">
            <h2 class="update-con-dtl">Update Contact Details</h2>
            <form method="POST" action="" class="add-contact-dtl">
                <div class="form-group label-row">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo htmlspecialchars($data['address']); ?>" required>
                </div>
                <div class="form-group label-row">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo htmlspecialchars($data['email']); ?>" required>
                </div>
                <div class="form-group label-row">
                    <label for="pn1" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="pn1" name="pn1"
                        value="<?php echo htmlspecialchars($data['pn1']); ?>" required>
                </div>
                <div class="add-room-btn">
                    <button type="submit" class="btn btn-primary">Update Contact Details</button>
                </div>
            </form>
        </div>

        <!-- Include your JS files here -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

         <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminDropdown');
            const icon = document.getElementById('toggleIcon');

            // Toggle the sidebar visibility
            if (sidebar.classList.contains('show')) {
                sidebar.classList.remove('show'); // Collapse the sidebar
                icon.className = 'bx bx-menu';    // Change icon to hamburger
            } else {
                sidebar.classList.add('show');    // Expand the sidebar
                icon.className = 'fas fa-times';  // Change icon to close (×)
            }
        }
    </script>

    <script src="admin-index.js"></script>
</body>

</html>