<!-- TODO: Add validation for employer login -->
<?php
    
    if (isset($_POST['submit'])) {

        $admin = htmlentities($_POST['admin']);
        $password = htmlentities($_POST['password']);

    }
?>

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
            <p><u>Employer Login</u></p>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Admin</label><br>
                <input type="text" name ="admin"><br><br>

                <label>Password</label><br>
                <input type="password" name ="password"><br><br>

                <input type="submit" class="button" name="submit" style="margin-left:6px;"><br>
            </form>

            <!-- Basic PHP to check whether anything has been entered, using vars at top. -->
            <?php if(!empty($admin) && !empty($password)): ?>
                <small style="text-align:center;">You have entered a username and a password.</small>
            <?php else: ?>
                <small style="text-align:center;">Please enter a valid username and passsword.</small>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>