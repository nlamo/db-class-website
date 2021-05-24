<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Employer Login Page</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <p><u>Employer Login</u></p><br>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Admin</label><br>
                <input type="text" name ="admin"><br><br>

                <label>Password</label><br>
                <input type="password" name ="password"><br><br>

                <input type="submit" class="button" name="submit" style="margin-left:11px;"><br>
            </form>

            <!-- Very, very basic validation for username/password -->
            <!-- Will remove the small user-message element otherwise -->
            <?php if ( isset($_POST['submit']) && (empty($admin) || empty($password)) ): ?>
                <small id="user-message" style="text-align:center;">Please enter a valid username and password.</small>
            <?php else: ?>
                <script>
                    var userMes = document.getElementById("user-message");
                    userMes.remove();
                </script>
            <?php endif; ?>

        </div>

        <br><a href="../index.php">Return to Home</a>
    </div>
</body>
</html>

<!-- NOTE: This provides the actual validation for the redirect-->
<!-- TODO: Imrpove validation  -->
<?php
    
    if (isset($_POST['submit'])) {

        $admin = htmlentities($_POST['admin']);
        $password = htmlentities($_POST['password']);

        // testing 
        if (!empty($admin) && !empty($password)) {
            header("Location: dashboard-employer.html");
            exit();
        }
    }
?>