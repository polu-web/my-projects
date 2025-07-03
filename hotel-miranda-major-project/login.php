<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
      <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="style.css">
    <title>Hotel Miranda User Login</title>
</head>

<body>

    <div class="login-box">
        <div class="container">
            <div class="popup">

                <form method="POST" action="login_register.php">
                    <h2>
                        <span>USER LOGIN</span>
                        <button type="reset" onclick="popup('login-popup')">X</button>
                    </h2>
                    <input type="text" placeholder="E-mail or Username" name="email_username" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <button type="submit" class="login-btn" name="login">LOGIN</button>
                </form>
                <div class="no-account">
                    <p>
                        Don't have an account?
                    </p>
                    <a href="register.php">Sign Up</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Toastify Notification -->
    <?php if (isset($_SESSION['toast_message'])): ?>
        <script>
            Toastify({
                text: "<?php echo $_SESSION['toast_message']; ?>",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "<?php echo $_SESSION['toast_color']; ?>",
                stopOnFocus: true
            }).showToast();
        </script>
        <?php
        // Clear session variables after displaying the toast
        unset($_SESSION['toast_message'], $_SESSION['toast_color']);
        ?>
    <?php endif; ?>
</body>

</html>