<?php
require('essentials.php');
require('db-config.php');

session_start();
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('../admin/dashboard.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="admin-style.css">
    <title>Admin Login</title>

</head>

<body class="login-box-admin">
    <div class="background-img1">
        <div class="login-form">
            <form method="POST" class="admin-form">
                <h2>ADMIN LOGIN PANEL</h2>
                <div class="admin-login-box">
                    <div class="admin-name-pass">
                        <div class="a-name">
                            <input name="admin_name" required type="text" class="form-control shadow-none text-center"
                                placeholder="Admin Name">
                        </div>
                        <div class="a-pass">
                            <input name="admin_pass" required type="password"
                                class="form-control shadow-none text-center" placeholder="Admin Password">
                        </div>
                        <button name="login" type="submit" class="login-button">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup alert for invalid login -->
    <div id="login-error" class="alert-popup">
        <span class="close-btn" onclick="closeAlert()">×</span>
        Login Failed!- You are not an Admin Member.
    </div>

    <?php

    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];


        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('../admin/dashboard.php');

        } else {
            // Show the alert at the top of the page
            echo "<script>
                    document.getElementById('login-error').style.display = 'block';
                  </script>";
        }
    }
    ?>

    <script>
        // Function to close the alert popup
        function closeAlert() {
            document.getElementById('login-error').style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="admin-index.js"></script>
</body>

</html>