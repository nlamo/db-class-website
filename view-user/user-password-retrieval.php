<?php
    session_start();

    // code to retrieve a forgotten password by answering a security question
    require('../php/forgot-password-user.php');

    if (isset($_SESSION['passwordResult'])) {

        $yourPassword = $_SESSION['passwordResult'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
    <title>User Forgot Password</title>
</head>
<body>

    <div class="container">
        <h2 class="career-portal-heading">Web Career Portal</h2>
    </div>

    <div class="container">
        <div class="card" style="width: 375px; height: 425px;">
            <p><u>Retrieve Your Password</u></p><br>

            <form method="POST" action="">
                <label>Username</label><br>
                <input type="text" name="user"><br><br>

                <label>Security Question:</label><br>
                <div class="security-question">What is your favourite film of<br> all time?</div>

                <input type="text" name="security-answer"><br><br>

                <button type="submit" class="button" name="get-password" style="margin-left:11px;">
                    Get Password
                </button><br>
            </form>

            <?php if (isset($_SESSION['passwordResult'])): ?>

                <?php echo '<small>Here is your password... securely:  <b>' . $yourPassword . '</b></small>'?>

            <?php endif; ?>

        </div>
    </div>

    <small>
        <br><br><a href="index.php" style="a:hover:">Return to Login</a>
    </small>
</body>
</html>
