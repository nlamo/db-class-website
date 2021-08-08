<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php
    
    if (isset($_POST['submit'])) {

        require('../php-config/database.php');

        $loginAttempt = true;
        $loginSuccess = false;
        $employer = mysqli_real_escape_string($conn, $_POST['employer']);
        $employerPassword = mysqli_real_escape_string($conn, $_POST['employer-password']);


        // NOTE: Correctness of password is defined both in terms of the correct user type
        //       and correctness of the password itself.

        // Get count; if 1, then exists, if 0, then doesn't exist
        $employerExistsQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer'";
        
        $passwordIsCorrectQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer' AND user.password='$employerPassword' AND (user.user_category='Admin' OR user.user_category LIKE 'Employer%')";
       
        $isAdminQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer' AND user.user_category='Admin'";


        // Running the queries
        $employerExists = mysqli_query($conn, $employerExistsQuery);
        $passwordIsCorrect = mysqli_query($conn, $passwordIsCorrectQuery);
        $isAdmin = mysqli_query($conn, $isAdminQuery);

        // Doing this thing...
        $employerRow = $employerExists->fetch_assoc();
        $passwordRow = $passwordIsCorrect->fetch_assoc();
        $adminRow = $isAdmin->fetch_assoc();
        
        // Getting the results... 
        $employerExistsResult = $employerRow['returnValue'];
        $passwordIsCorrectResult = $passwordRow['returnValue'];
        $isAdminResult = $adminRow['returnValue'];
        

        if (empty($employer) || empty($employerPassword)) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            require('../php-config/close-database.php');
            header("Location: index.php");
            exit();
        }
        
        if (!$employerExistsResult || !$passwordIsCorrectResult) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            require('../php-config/close-database.php');
            header("Location: index.php");
            exit();
        }

        if ($employerExistsResult && $passwordIsCorrectResult) {

            $loginAttempt = false;
            $loginSuccess = true;
            $_SESSION['loginAttempt'] = $loginAttempt;
            $_SESSION['loginSuccess'] = $loginSuccess;
            $_SESSION['employer'] = $employer;
            $_SESSION['employerPassword'] = $employerPassword;

            // special check for admin, who can also log in as "employer"
            if ($isAdminResult) {
                $_SESSION['isAdmin'] = $isAdminResult;
            }

            require('../php-config/close-database.php');
            header("Location: dashboard-employer.php");
            exit();
        }
    }
?>