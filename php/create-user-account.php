<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['create-user-account'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
        $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password= mysqli_real_escape_string($conn, $_POST['password']);
        $securityAnswer = mysqli_real_escape_string($conn, $_POST['security-answer']);
        
        $sqlQuery = "INSERT INTO user (username, employer_ID, user_category, first_name, last_name, email, password, security_answer, total_jobs_posted, total_applications_submitted, status) VALUES ('$user', NULL, 'User Basic', '$firstName', '$lastName', '$email', '$password', '$securityAnswer', 0, 0, 'active')";

        
        if (mysqli_query($conn, $sqlQuery)) {
            require('../php-config/close-database.php');
            header('Location: index.php');
            exit();
        }
        else {
            require('../php-config/close-database.php');
            header('Location: user-sign-up.php');
            exit();
        }
    }
?>