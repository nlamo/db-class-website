<?php
    session_start();

    // some basic authentication for user login
    require('../php/login-validation-employer.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Employer Login Page</title>
</head>
<body>

    <div class="container">
        <h2>Web Career Portal</h2>
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
        <!-- TODO: Implement a simple and hardly-secure password retrieval procedure based on a security question -->
        <br><br><a href="#" style="a:hover:">Forgot your password? Click here.</a>
        <br><br><a href="../index.html">Return to Home</a>
    </small>

</body>
</html>