<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>User Sign-Up</title>
</head>
<body>

    <div class="container">
        <h2 class="career-portal-heading">Web Career Portal</h2>
    </div>

    <div class="container">
        <div class="card" style="height: 700px; width: 450px;"> 
            <p><u>Create New Account</u></p><br>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Username</label><br>
                <input type="text" name ="user"><br><br>

                <label>Password</label><br>
                <input type="password" name="password"><br><br>

                <label>First Name</label><br>
                <input type="first-name" name="first-name"><br><br>

                <label>Last Name</label><br>
                <input type="last-name" name="last-name"><br><br>

                <label>E-mail</label><br>
                <input type="email" name="email"><br><br>

                <label>Security Question:</label><br>
                <div class="security-question">What is your favourite film of<br> all time?</div>
     
                <input type="security-answer" name="security-answer"><br><br>

                <button type="submit" class="button" name="submit" style="margin-left:11px;">
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