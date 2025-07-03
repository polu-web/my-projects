<?php
session_start(); // Start the session
require('connection.php'); // Include your database connection

// Registration logic
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // No hashing
    $dob = mysqli_real_escape_string($con, $_POST['dob']); // No hashing
    $phNo = mysqli_real_escape_string($con, $_POST['phNo']);



    // Check if username or email already exists
    $user_exist_query = "SELECT * FROM `registered_users` WHERE `username`='$username' OR `email`='$email'";
    $result = mysqli_query($con, $user_exist_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['username'] == $username) {
                echo "<script>alert('Username already taken'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Email already registered'); window.location.href='index.php';</script>";
            }
        } else {
            // Insert the new user
            $query = "INSERT INTO `registered_users`(`username`, `email`, `full_name`, `password`,`dob`,`phNo`) VALUES ('$username','$email','$fullname','$password','$dob','$phNo')";
            if (mysqli_query($con, $query)) {
                echo "<script>alert('Registration successful'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error running query'); window.location.href='index.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Error running query'); window.location.href='index.php';</script>";
    }
}

// Login logic
if (isset($_POST['login'])) {
    $email_username = mysqli_real_escape_string($con, $_POST['email_username']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // No need to trim here if it's handled elsewhere

    // Check if the input is an email or username
    if (filter_var($email_username, FILTER_VALIDATE_EMAIL)) {
        // It's an email
        $query = "SELECT * FROM `registered_users` WHERE `email`='$email_username'";
    } else {
        // It's a username
        $query = "SELECT * FROM `registered_users` WHERE `username`='$email_username'";
    }

    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $password_from_db = $user['password']; // Fetch the plain text password from the DB

            // Verify the password
            if ($password === $password_from_db) { // Direct comparison
                // Store user information in session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['loggedIn'] = true;
                echo "<script> window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Invalid password'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('User not found'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Error running query'); window.location.href='index.php';</script>";
    }
}

?>