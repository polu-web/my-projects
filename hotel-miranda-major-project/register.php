<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <link rel="icon" href="img/logo-icon.png" type="image/png" style="border-radius: 50%;">
    <link rel="stylesheet" href="style.css">
    <title>Hotel Miranda User Sign-up</title>
</head>

<body>
    <div class="login-box">

        <div class="register popup">

            <form method="POST" action="login_register.php">
                <h2>
                    <span>USER REGISTER</span>
                    <button type="reset" onclick="popup('register-popup')">X</button>
                </h2>
                <div class="row">
                    <div class="col-6">
                        <input type="text" placeholder="Full Name" name="fullname" required>
                    </div>
                    <div class="col-6">
                        <input type="text" placeholder="Username" name="username">
                    </div>
                    <div class="col-12">
                        <input type="email" placeholder="E-mail" name="email">
                    </div>
                    <div class="col-6">
                        <input type="number" placeholder="Phone-no." name="phNo">
                    </div>
                    <div class="col-6">
                        <input type="date" placeholder="Dob" name="dob">
                    </div>
                    <div class="col-12">
                        <input type="password" placeholder="Password" name="password">
                    </div>

                </div>
                <button type="submit" class="login-btn" name="register">REGISTER</button>
            </form>
        </div>

    </div>
</body>

</html>