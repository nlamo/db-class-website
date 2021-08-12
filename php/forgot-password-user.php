<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<!-- NOTE: Forgot password only for admin/user -->
<?php

    if (isset($_POST['get-password'])) {

        require('../php-config/database.php');

        if (isset($_POST['user']) && isset($_POST['security-answer']))
        {

            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $securityAnswerInput = htmlspecialchars($_POST['security-answer']);

            $correctSecurityAnswerQuery = "SELECT user.security_answer AS securityAnswer FROM user WHERE user.username='$user'";

            $passwordQuery = "SELECT user.password AS userPassword FROM user WHERE user.username='$user'";

            $isAdminOrUserQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$user' AND (user.user_category = 'Admin' OR user.user_category LIKE 'User%') ";

            // Running the queries to get the counts
            $correctSecurityAnswer = mysqli_query($conn, $correctSecurityAnswerQuery);
            $password = mysqli_query($conn, $passwordQuery);
            $isAdminOrUser = mysqli_query($conn, $isAdminOrUserQuery);

            // Doing this thing...
            $correctSecurityAnswerRow = $correctSecurityAnswer->fetch_assoc();
            $passwordRow = $password->fetch_assoc();
            $isAdminOrUserRow = $isAdminOrUser->fetch_assoc();

            // Getting the results...
            $correctSecurityAnswerResult = $correctSecurityAnswerRow['securityAnswer'];
            $passwordResult = $passwordRow['userPassword'];
            $isAdminOrUserResult = $isAdminOrUserRow['returnValue'];

            // if it's right, redirect to the same page with password
            // else if it's wrong, redirect without password
            if ( (strcmp($securityAnswerInput, $correctSecurityAnswerResult) === 0) && $isAdminOrUserResult ) {
                $_SESSION['passwordResult'] = $passwordResult;
                require('../php-config/close-database.php');
                header("Location: user-password-retrieval.php");
                exit();
            }
            else {
                require('../php-config/close-database.php');
                header("Location: user-password-retrieval.php");
                exit();
            }
        }

        require('../php-config/close-database.php');
        header("Location: user-password-retrieval.php");
    }
?>
