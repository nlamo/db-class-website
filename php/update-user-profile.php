<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['update-user-profile'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_SESSION['user']);
        $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
        $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $securityAnswer = mysqli_real_escape_string($conn, $_POST['security-answer']);

        if (!empty($firstName)) {
            $sqlQuery = "UPDATE user SET user.first_name='$firstName' WHERE user.username='$user'";
            mysqli_query($conn, $sqlQuery);
        }
        
        if (!empty($lastName)) {
            $sqlQuery = "UPDATE user SET user.last_name='$lastName' WHERE user.username='$user'";
            mysqli_query($conn, $sqlQuery);
        }

        if (!empty($email)) {
            $sqlQuery = "UPDATE user SET user.email='$email' WHERE user.username='$user'";
            mysqli_query($conn, $sqlQuery);
        }

        if (!empty($password)) {
            $sqlQuery = "UPDATE user SET user.password='$password' WHERE user.username='$user'";
            mysqli_query($conn, $sqlQuery);
        }

        if (!empty($securityAnswer)) {
            $sqlQuery = "UPDATE user SET user.security_answer='$securityAnswer' WHERE user.username='$user'";
            mysqli_query($conn, $sqlQuery);
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }
    
?>