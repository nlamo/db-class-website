<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['maintain-submit'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $userStatus = mysqli_real_escape_string($conn, $_POST['user-status']);

        // This will change a user status, but an administrator status cannot be changed
        if (!empty($user) && !empty($userStatus)) {

            $sqlQuery = "UPDATE user SET user.status='$userStatus' WHERE user.username='$user' AND user.user_category != 'Admin' ";

            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }
        }
        else 
        {
            $_SESSION['querySuccessful'] = false;
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer.php');
        exit();
    }
    
?>
