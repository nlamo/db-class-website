<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // TODO: Non-functional! And I am not sure why.

    if (isset($_POST['create-employer-account'])) {

        require('../php-config/database.php');

        $employer = mysqli_real_escape_string($conn, $_POST['employer']);
        $employerID = mysqli_real_escape_string($conn, $_POST['employer-id']);
        $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
        $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password= mysqli_real_escape_string($conn, $_POST['password']);
        $securityAnswer = mysqli_real_escape_string($conn, $_POST['security-answer']);

        $sqlQuery = "INSERT INTO user (username, employer_ID, user_category, first_name, last_name, email, password, security_answer, total_jobs_posted, total_applications_submitted, status) VALUES ('$employer', '$employerID', 'Employer Prime', '$firstName', '$lastName', '$email', '$password', '$securityAnswer', 0, 0, 'active')";

        
        if (mysqli_query($conn, $sqlQuery)) {
            require('../php-config/close-database.php');
            header('Location: index.php');
            exit();
        }
        else {
            require('../php-config/close-database.php');
            header('Location: employer-sign-up.php');
            exit();
        }
    }
?>