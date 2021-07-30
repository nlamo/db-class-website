<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->
<?php

    session_start();

    if (isset($_POST['submit'])) {

        $loginAttempt = true;
        $user = htmlentities($_POST['user']);
        $userPassword = htmlentities($_POST['userPassword']);

        $_SESSION['user'] = $user;
        $_SESSION['userPassword'] = $userPassword;

        if (!empty($user) && !empty($userPassword)) {
            header("Location: dashboard-user.php");
            exit();
        }
        else {
            // using the loginAttempt SESSION variable as condition for login message error
            $_SESSION['loginAttempt'] = $loginAttempt;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>User Login Page</title>
</head>
<body>

    <div class="container">
        <h2>Web Career Portal</h2>
    </div>

    <div class="container">
        <div class="card">
            <p><u>User Login</u></p><br>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Username</label><br>
                <input type="text" name ="user"><br><br>

                <label>Password</label><br>
                <input type="password" name="userPassword"><br><br>

                <button type="submit" class="button" name="submit" style="margin-left:11px;">
                    Submit
                </button><br>
            </form>
            
            <!-- Login validation -->
            <?php if (isset($_SESSION['loginAttempt'])): ?>
                
                <?php if ( empty($_SESSION['employer']) || empty($_SESSION['userPassword']) ): ?>

                    <small id="user-message" style="text-align:center;">Please enter a valid username and password.</small>

                <?php else: ?>

                    <script>
                        var userMes = document.getElementById("user-message");
                        userMes.remove();
                    </script>

                <?php endif; ?>
            <?php endif; ?>  
        </div>       
    </div>

    <br><a href="../index.html" style="a:hover:">Return to Home</a>
</body>
</html>