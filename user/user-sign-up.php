<?php 

    // creating a new user account
    require('../php/create-user-account.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
    <title>User Sign-Up</title>
</head>
<body>

    <div class="container">
        <h2 class="career-portal-heading">Web Career Portal</h2>
    </div>

    <div class="container">

        <div class="card-sign-up"> 
            <p>Create New Account</p><br>

            <form method="POST" action="">
                <label>Username</label><br>
                <input type="text" name="user"><br><br>

                <label>First Name</label><br>
                <input type="text" name="first-name"><br><br>

                <label>Last Name</label><br>
                <input type="text" name="last-name"><br><br>

                <label>E-mail</label><br>
                <input type="text" name="email"><br><br>

                <label>Password</label><br>
                <input type="password" name="password"><br><br>

                <label>Security Question:</label><br>
                <div class="security-question">What is your favourite film of<br> all time?</div>
     
                <input type="text" name="security-answer"><br><br>

                <button type="submit" class="button" name="create-user-account">
                    Create Account
                </button><br>
            </form> 
        </div>       
    </div>

    <small>
        <br><br><a href="./index.php" style="a:hover:">Return to User Login</a>
    </small>

</body>
</html>