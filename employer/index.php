<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->
<?php

    session_start();

    if (isset($_POST['submit'])) {

        $loginAttempt = true;
        $employer = htmlentities($_POST['employer']);
        $employerPassword = htmlentities($_POST['employerPassword']);

        $_SESSION['employer'] = $employer;
        $_SESSION['employerPassword'] = $employerPassword;

        if (!empty($employer) && !empty($employerPassword)) {
            header("Location: dashboard-employer.php");
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
    <title>Employer Login Page</title>
</head>
<body>

    <div class="container">
        <h2>Web Career Portal</h2>
    </div>

    <div class="container">
        <div class="card">
            <p><u>Employer Login</u></p><br>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Username</label><br>
                <input type="text" name ="employer"><br><br>

                <label>Password</label><br>
                <input type="password" name="employerPassword"><br><br>

                <button type="submit" class="button" name="submit" style="margin-left:11px;">
                    Login
                </button><br>
            </form>

            <!-- Login validation -->
            <?php if (isset($_SESSION['loginAttempt'])): ?>
                
                <?php if ( empty($_SESSION['employer']) || empty($_SESSION['employerPassword']) ): ?>

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

    <small>
        <!-- TODO: Implement a simple and hardly-secure password retrieval procedure based on a security question -->
        <br><br><a href="#" style="a:hover:">Forgot your password? Click here.</a>
        <br><br><a href="../index.html">Return to Home</a>
    </small>

</body>
</html>