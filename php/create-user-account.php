<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // TODO: Non-functional! And I am not sure why.

    if (isset($_POST['create-user-account'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $employerID = mysqli_real_escape_string($conn, $employerIDValue);
        $userCategory = mysqli_real_escape_string($conn, $userCategoryValue);
        $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
        $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password= mysqli_real_escape_string($conn, $_POST['password']);
        $securityAnswer = mysqli_real_escape_string($conn, $_POST['security-answer']);
        $jobsPosted = mysqli_real_escape_string($conn, $jobsPostedValue);
        $applicationsSubmitted = mysqli_real_escape_string($conn, $applicationsSubmittedValue);
        $userStatus = mysqli_real_escape_string($conn, $userStatusValue);

        // NOTE: This data is failing to insert and I am genuinely puzzled.
        
        $sqlQuery = "INSERT INTO user (username, employer_ID, user_category, first_name, last_name, email, password, security_answer, total_jobs_posted, total_applications_submitted, status) VALUES ('$user', NULL, 'User Basic', '$firstName', '$lastName', '$email', '$password', '$securityAnswer', 0, 0, 'active')";

        
        if (mysqli_query($conn, $sqlQuery)) {
            require('../php-config/close-database.php');
            header('Location: index.php');
            exit();
        }
        else {
            require('../php-config/close-database.php');
            header('Location: sign-up.php');
            exit();
        }
    }
?>