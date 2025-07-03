<?php
require('connection.php');
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
include('admin/db-config.php');

$message = '';
$room = null;
$showPaymentLink = false;
$imageUrl = '';

// Fetch room details if room_id is provided via GET
if (isset($_GET['room_id'])) {
    $room_id = (int) $_GET['room_id'];

    // Get room details (name, price, features, payment_link)
    $stmt = $con->prepare("SELECT name, price, features, image, payment_link FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();
    $stmt->close();

    // Get image URL from GET parameter passed by rooms.php
    if (isset($_GET['image'])) {
        $imageUrl = htmlspecialchars($_GET['image']);
    }
} else {
    $message = "No room selected.";
}

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = (int) $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    if ($check_in >= $check_out) {
        $message = "Check-out date must be after check-in date.";
    } else {
        // Check overlapping bookings
        $stmt = $con->prepare("
            SELECT COUNT(*) FROM bookings
            WHERE room_id = ? AND
            (check_in < ? AND check_out > ?)
        ");
        $stmt->bind_param("iss", $room_id, $check_out, $check_in);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $message = "Sorry, this room is already booked for the selected dates.";
        } else {
            // Insert booking
            $stmt = $con->prepare("INSERT INTO bookings (room_id, check_in, check_out) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $room_id, $check_in, $check_out);

            if ($stmt->execute()) {
                $message = "Booking successful! Please proceed to payment.";
                $showPaymentLink = true;
            } else {
                $message = "Error during booking: " . $con->error;
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <title>Book Room</title>
    <style>
       
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 25px;
            margin-top: 20px;
        }

        .message {
            margin: 15px 0;
            padding: 12px;
            border-radius: 5px;
            font-weight: 600;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .room-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .booking-container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .information-div{
             box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
              background: white;
            padding: 25px 30px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: 600;
            color: #555;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #ddd;
            border-radius: 7px;
            margin-top: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"] {
            margin-top: 25px;
            padding: 12px 0;
            width: 100%;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .pay-now {
            display: block;
            text-align: center;
            margin: 30px auto 0 auto;
            padding: 14px 0;
            width: 200px;
            background-color: #28a745;
            color: white;
            font-weight: 700;
            font-size: 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .pay-now:hover {
            background-color: #19692c;
        }
        .img-div{
            width: 40%;
        }
        .information-div{
            width: 60%;
            margin-left: 20px;
        }

        .availability {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-body{
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container form-body">
        <h1>Room Booking</h1>

        <?php if ($message): ?>
            <div class="message <?= (strpos($message, 'successful') !== false) ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h2><?= htmlspecialchars($room['name']) ?></h2>
        <div class="availability">
            <?php if ($room): ?>
                <div class="img-div">
                    <?php
                    // Prepare image path
                    $imagePath = 'admin/' . $room['image'];
                    if (!file_exists($imagePath)) {
                        $imagePath = 'default.jpg'; // fallback image if needed
                    }
                    ?>
                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="Room Image" class="room-image" />

                </div>
                <div class=" information-div">
                    <p><strong>Price:</strong> ₹<?= htmlspecialchars($room['price']) ?></p>
                    <p><strong>Features:</strong><br><?= nl2br(htmlspecialchars($room['features'])) ?></p>

                    <div class="booking-container">
                        <form method="POST"
                            action="room-book.php?room_id=<?= $room_id ?>&image=<?= urlencode($imageUrl) ?>">
                            <input type="hidden" name="room_id" value="<?= $room_id ?>" />

                            <label for="check_in">Check-in Date:</label>
                            <input type="date" name="check_in" id="check_in" required />

                            <label for="check_out">Check-out Date:</label>
                            <input type="date" name="check_out" id="check_out" required />

                            <button type="submit">Book Now</button>
                        </form>
                    </div>

                    <?php if ($showPaymentLink && !empty($room['payment_link'])): ?>
                        <a href="<?= htmlspecialchars($room['payment_link']) ?>" target="_blank" class="pay-now">Pay Now</a>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <p>No room selected or room not found.</p>
            <?php endif; ?>
        </div>
    </div>
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