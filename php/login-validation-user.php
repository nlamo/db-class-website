<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php
    
    if (isset($_POST['submit'])) {

        require('../php-config/database.php');

        $loginAttempt = true;
        $loginSuccess = false;
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $userPassword = mysqli_real_escape_string($conn, $_POST['user-password']);

        // NOTE: Correctness of password is defined both in terms of the correct user type
        //       and correctness of the password itself.

        // User 'exists' if it is in the database AND has a status of 'active'
        $userExistsQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$user' AND user.status='active'";

        $passwordIsCorrectQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$user' AND user.password='$userPassword' AND (user.user_category='Admin' OR user.user_category LIKE 'User%')";

        // Check if the user has a frozen payment account
        $hasFrozenAccountQuery = "SELECT COUNT(*) AS returnValue FROM payment_account WHERE payment_account.username='$user' AND payment_account.status='Frozen'";

        // Running the queries to get the counts
        $userExists = mysqli_query($conn, $userExistsQuery);
        $passwordIsCorrect = mysqli_query($conn, $passwordIsCorrectQuery);
        $hasFrozenAccount = mysqli_query($conn, $hasFrozenAccountQuery);

        // Doing this thing...
        $userRow = $userExists->fetch_assoc();
        $passwordRow = $passwordIsCorrect->fetch_assoc();
        $frozenAccountRow = $hasFrozenAccount->fetch_assoc();
        
        // Getting the results... 
        $userExistsResult = $userRow['returnValue'];
        $passwordIsCorrectResult = $passwordRow['returnValue'];
        $hasFrozenAccountResult = $frozenAccountRow['returnValue'];

        if (empty($user) || empty($userPassword)) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            require('../php-config/close-database.php');
            header("Location: index.php");
            exit();
        }
        
        if (!$userExistsResult || !$passwordIsCorrectResult) {
            $_SESSION['loginAttempt'] = $loginAttempt;
            require('../php-config/close-database.php');
            header("Location: index.php");
            exit();
        }

        if ($userExistsResult && $passwordIsCorrectResult) {

            $loginAttempt = false;
            $loginSuccess = true;
            $_SESSION['loginAttempt'] = $loginAttempt;
            $_SESSION['loginSuccess'] = $loginSuccess;
            $_SESSION['user'] = $user;
            $_SESSION['userPassword'] = $userPassword;
            $_SESSION['hasFrozenAccount'] = $hasFrozenAccountResult;

            require('../php-config/close-database.php');
            header("Location: dashboard-user.php");
            exit();
        }
    }
?>