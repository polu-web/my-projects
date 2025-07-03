<?php
include('db-config.php');  // Include the database connection

// Image upload function
function uploadImage($file)
{
    $target_dir = "uploads/";
    $filename = time() . "_" . basename($file["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    }
    return null;
}

// Delete room
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $con->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: room-management.php");
    exit;
}

// Edit room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_room'])) {
    $id = $_POST['room_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $features = $_POST['features'];
    $rating = $_POST['rating'];
    $payment_link = $_POST['payment_link'];

    if ($_FILES['image']['name']) {
        $image = uploadImage($_FILES['image']);
        $stmt = $con->prepare("UPDATE rooms SET name=?, price=?, features=?, image=?, rating=?, payment_link=? WHERE id=?");
        $stmt->bind_param("sissisi", $name, $price, $features, $image, $rating, $payment_link, $id);
    } else {
        $stmt = $con->prepare("UPDATE rooms SET name=?, price=?, features=?, rating=?, payment_link=? WHERE id=?");
        $stmt->bind_param("sisisi", $name, $price, $features, $rating, $payment_link, $id);
    }

    $stmt->execute();
    header("Location: room-management.php");
    exit;
}

// Add room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_room'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $features = $_POST['features'];
    $rating = $_POST['rating'];
    $payment_link = $_POST['payment_link'];
    $image = uploadImage($_FILES['image']);

    if ($image) {
        $stmt = $con->prepare("INSERT INTO rooms (name, price, features, image, rating, payment_link) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissis", $name, $price, $features, $image, $rating, $payment_link);
        $stmt->execute();
    }

    header("Location: room-management.php");
    exit;
}

// Fetch all rooms
$result = $con->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
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

    <div class="row dash-wrap">
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
                            <li class="nav-item"><a class="nav-link admin-hover" href="room-management.php">Rooms</a></li>
                            <li class="nav-item"><a class="nav-link" href="users-management.php">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                             <li class="nav-item"><a class="nav-link" href="view-message.php">View Messages</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>



        <div class="col-md-9 container mt-5" id="main-content">
            <h2 class="mb-4 room-manage">Room Management</h2>

            <!-- Add Room Form -->
            <form method="POST" enctype="multipart/form-data" class="add-room">
                <h4 class="room-heading">Add New Room</h4>
                <div class="label-row">
                    <label class="form-label">Room Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="label-row">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="label-row">
                    <label class="form-label">Features</label>
                    <textarea name="features" class="form-control" required></textarea>
                </div>
                <div class="label-row">
                    <label class="form-label">Rating (1–5)</label>
                    <input type="number" name="rating" class="form-control" min="1" max="5" required>
                </div>
                <div class="label-row">
                    <label class="form-label">Stripe Payment Link</label>
                    <input type="url" name="payment_link" class="form-control" placeholder="https://buy.stripe.com/..."
                        required>
                </div>
                <div class="label-row">
                    <label class="form-label">Room Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="add-room-btn mt-3">
                    <button type="submit" name="add_room" class="btn btn-primary">Add Room</button>
                </div>
            </form>

            <!-- Room List -->
            <h4 class="mb-3 mt-5 room-heading">Existing Rooms</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Features</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $modals = '';
                        while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td style="width:40%"><img src="<?= htmlspecialchars($row['image']) ?>" width="100"
                                        class="img-thumbnail"></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td>₹<?= htmlspecialchars($row['price']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['features'])) ?></td>
                                <td><?= htmlspecialchars($row['rating']) ?> ★</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger mb-2"
                                        onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php ob_start(); ?>
                            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" enctype="multipart/form-data" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Room</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="room_id" value="<?= $row['id'] ?>">
                                            <div class="label-row">
                                                <label class="form-label">Room Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="<?= htmlspecialchars($row['name']) ?>" required>
                                            </div>
                                            <div class="label-row">
                                                <label class="form-label">Price (₹)</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="<?= $row['price'] ?>" required>
                                            </div>
                                            <div class="label-row">
                                                <label class="form-label">Features</label>
                                                <textarea name="features" class="form-control"
                                                    required><?= htmlspecialchars($row['features']) ?></textarea>
                                            </div>
                                            <div class="label-row">
                                                <label class="form-label">Rating (1–5)</label>
                                                <input type="number" name="rating" class="form-control" min="1" max="5"
                                                    value="<?= $row['rating'] ?>" required>
                                            </div>
                                            <div class="label-row">
                                                <label class="form-label">Stripe Payment Link</label>
                                                <input type="url" name="payment_link" class="form-control"
                                                    value="<?= htmlspecialchars($row['payment_link']) ?>" required>
                                            </div>
                                            <div class="label-row">
                                                <label class="form-label">Update Image (optional)</label>
                                                <input type="file" name="image" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="edit_room" class="btn btn-success">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php $modals .= ob_get_clean(); ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
          

            <?= $modals ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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