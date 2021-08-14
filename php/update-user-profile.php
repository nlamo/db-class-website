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

        
        // NOTE: This 'logic' is fine for the time being, but realistically, there is an issue. If one of the queries returns false, and sets the SESSION variable, it can still by overriden by a successful query to follow. Since there's only one alert() that is triggered, this could produce a 'false positive' of sorts. Nevertheless, all of the queries are working.

        if (!empty($firstName)) {
            $sqlQuery = "UPDATE user SET user.first_name='$firstName' WHERE user.username='$user'";
              
            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }
        
        if (!empty($lastName)) {
            $sqlQuery = "UPDATE user SET user.last_name='$lastName' WHERE user.username='$user'";
           
            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }

        if (!empty($email)) {
            $sqlQuery = "UPDATE user SET user.email='$email' WHERE user.username='$user'";
             
            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }

        if (!empty($password)) {
            $sqlQuery = "UPDATE user SET user.password='$password' WHERE user.username='$user'";
              
            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }

        if (!empty($securityAnswer)) {
            $sqlQuery = "UPDATE user SET user.security_answer='$securityAnswer' WHERE user.username='$user'";
            
            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }
    
?>