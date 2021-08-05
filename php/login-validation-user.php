<?php
    require('../php-config/database.php');

    session_start();

    if (isset($_POST['submit'])) {

        $loginAttempt = true;
        $loginSuccess = false;
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $userPassword = mysqli_real_escape_string($conn, $_POST['user-password']);

        // Get count; if 1, then exists, if 0, then doesn't exist
        $userExistsQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$user'";
        $passwordIsCorrectQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$user' AND user.password='$userPassword'";

        // Running the queries to get the counts
        $userExists = mysqli_query($conn, $userExistsQuery);
        $passwordIsCorrect = mysqli_query($conn, $passwordIsCorrectQuery);

        // Doing this thing...
        $userRow = $userExists->fetch_assoc();
        $passwordRow = $passwordIsCorrect->fetch_assoc();
        
        // Getting the results... 
        $userExistsResult = $userRow['returnValue'];
        $passwordIsCorrectResult = $passwordRow['returnValue'];

        if (empty($user) || empty($userPassword)) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            header("Location: index.php");
            exit();
        }
        
        if (!$userExistsResult || !$passwordIsCorrectResult) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            header("Location: index.php");
            exit();
        }

        if ($userExistsResult && $passwordIsCorrectResult) {

            $loginSuccess = true;
            $_SESSION['loginSuccess'] = $loginSuccess;
            $_SESSION['user'] = $user;
            $_SESSION['userPassword'] = $userPassword;

            header("Location: dashboard-user.php");
            exit();
        }
    }

    require('../php-config/close-database.php');
?>