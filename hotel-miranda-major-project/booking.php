<?php
session_start(); // Start the session
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking'])) {
    $fullname = $_POST['fullname'];

    $sql = "INSERT INTO booking_users (full_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname);

    if ($stmt->execute()) {
        echo "Booking registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
