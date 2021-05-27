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

    <!-- TODO: Add functionality to verify credentials. (PHP) -->
    <div class="container">
        <div class="card">
            <p><u>User Login</u></p><br>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>User</label><br>
                <input type="text" name ="user"><br><br>

                <label>Password</label><br>
                <input type="password" name ="password"><br><br>

                <input type="submit" class="button" name="submit" style="margin-left:11px;">
            </form>
            
            <!-- Very, very basic validation for username/password -->
            <!-- Will remove the small user-message element otherwise -->
            <?php if ( isset($_POST['submit']) && (empty($user) || empty($password)) ): ?>
                <small id="user-message" style="text-align:center;">Please enter a valid username and password.</small>
            <?php else: ?>
                <script>
                    var userMes = document.getElementById("user-message");
                    userMes.remove();
                </script>
            <?php endif; ?>

        </div>       
    </div>

    <br><a href="../index.html">Return to Home</a>
</body>
</html>

<!-- NOTE:  This provides the actual validation for the redirect-->
<!-- TODO:  Improve validation and refactor. Perhaps find a better way of dealing with the       
            message than removing it with JavaScript. -->
<?php
    
    if (isset($_POST['submit'])) {

        $user = htmlentities($_POST['user']);
        $password = htmlentities($_POST['password']);

        // testing 
        if (!empty($user) && !empty($password)) {
            header("Location: dashboard-user.php");
            exit();
        }
    }
?>