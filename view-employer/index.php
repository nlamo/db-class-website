<?php
    session_start();

    // unsetting session variable if relevant (e.g. used in dashboard view)
    unset($_SESSION['isAdmin']);
    unset($_SESSION['employer']);
    unset($_SESSION['passwordResult']);

    // some basic authentication for user login
    require('../php/login-validation-employer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Employer Login Page</title>
</head>
<body>

    <div class="container">
        <h2>: : Web Career Portal : :</h2>
    </div>

    <div class="container">
        <div class="card">
            <p><u>Employer Login</u></p><br>

            <form method="POST" action="">
                <label>Username</label><br>
                <input type="text" name="employer"><br><br>

                <label>Password</label><br>
                <input type="password" name="employer-password"><br><br>

                <button type="submit" class="button" name="submit" style="margin-left:11px;">
                    Login
                </button><br>
            </form>

            <?php if (isset($_SESSION['loginAttempt'])): ?>

                <!-- Login validation -->
                <?php if (($_SESSION['loginAttempt'])): ?>

                    <small id="user-message" style="text-align:center;">Please enter a valid username and password.</small>

                <?php elseif(!($_SESSION['loginAttempt'])): ?>

                    <script>
                        var userMes = document.getElementById("user-message");
                        userMes.remove();
                    </script>

                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

    <small>
        <br><br><b><a href="./employer-sign-up.php" style="a:hover:">New here? Sign up for an account.</a></b>

        <br><br><a href="employer-password-retrieval.php" style="a:hover:">Forgot your password? Click here.</a>

        <br><br><a href="../index.html">Return to Home</a>
    </small>

</body>
</html>
