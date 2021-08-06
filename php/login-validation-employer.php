<?php
    require('../php-config/database.php');

    session_start();

    if (isset($_POST['submit'])) {

        $loginAttempt = true;
        $loginSuccess = false;
        $employer = mysqli_real_escape_string($conn, $_POST['employer']);
        $employerPassword = mysqli_real_escape_string($conn, $_POST['employer-password']);


        // NOTE: Correctness of password is defined both in terms of the correct user type
        //       and correctness of the password itself.

        // Get count; if 1, then exists, if 0, then doesn't exist
        $employerExistsQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer'";
        $passwordIsCorrectQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer' AND user.password='$employerPassword' AND (user.user_category='Admin' OR user.user_category LIKE 'Employer%')";


        // Running the queries
        $employerExists = mysqli_query($conn, $employerExistsQuery);
        $passwordIsCorrect = mysqli_query($conn, $passwordIsCorrectQuery);

        // Doing this thing...
        $employerRow = $employerExists->fetch_assoc();
        $passwordRow = $passwordIsCorrect->fetch_assoc();
        
        // Getting the results... 
        $employerExistsResult = $employerRow['returnValue'];
        $passwordIsCorrectResult = $passwordRow['returnValue'];
        
        if (empty($employer) || empty($employerPassword)) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            header("Location: index.php");
            exit();
        }
        
        if (!$employerExistsResult || !$passwordIsCorrectResult) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            header("Location: index.php");
            exit();
        }

        if ($employerExistsResult && $passwordIsCorrectResult) {

            $loginAttempt = false;
            $loginSuccess = true;
            $_SESSION['loginAttempt'] = $loginAttempt;
            $_SESSION['loginSuccess'] = $loginSuccess;
            $_SESSION['user'] = $user;
            $_SESSION['userPassword'] = $userPassword;

            header("Location: dashboard-employer.php");
            exit();
        }
    }

    require('../php-config/close-database.php');
?>