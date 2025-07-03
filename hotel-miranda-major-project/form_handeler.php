<?php
session_start(); // Start the session
require('connection.php'); // Include your database connection


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phno = htmlspecialchars(trim($_POST['phno']));
    $msg = htmlspecialchars(trim($_POST['msg']));

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($phno) && !empty($msg)) {
      $query = "INSERT INTO `message-box`(`name`,`email`,`phno`,`msg`) VALUES ('$name','$email','$phno','$msg')";
            if (mysqli_query($con, $query)) {
                echo "<script>alert('message submited successfully'); window.location.href='contact.php';</script>";
            } else {
                echo "<script>alert('Error running query'); window.location.href='contact.php';</script>";
            }
    } else {
        echo "<h1>Error: All fields are required!</h1>";
    }
} else {
    echo "<h1>Invalid Request Method</h1>";
}

?>

