<?php
    require('../php-config/database.php');

    session_start();

    if (isset($_POST['submit'])) {

        $loginAttempt = true;
        $loginSuccess = false;
        $employer = mysqli_real_escape_string($conn, $_POST['employer']);
        $employerPassword = mysqli_real_escape_string($conn, $_POST['employer-password']);

        // Get count; if 1, then exists, if 0, then doesn't exist
        $employerExistsQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer'";
        $passwordIsCorrectQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer' AND user.password='$employerPassword'";

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

            $loginSuccess = true;
            $_SESSION['loginSuccess'] = $loginSuccess;
            $_SESSION['employer'] = $employer;
            $_SESSION['employerassword'] = $employerPassword;

            header("Location: dashboard-employer.php");
            exit();
        }
    }

    require('../php-config/close-database.php');
?>