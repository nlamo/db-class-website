<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<!-- TODO: Modify this to change the status of a given user (active/inactive), for admin use only! -->

<?php

    if (isset($_POST['maintain-submit'])) {

        require('../php-config/database.php');

        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $userCategory = mysqli_real_escape_string($conn, $_POST['user-category']);

        // You will only be permitted to update a user given that the user is not admin
        if (!empty($username) && !empty($userCategory)) {

            $sqlQuery = "UPDATE user SET user.user_category='$userCategory' WHERE user.username='$username' AND user.user_category != 'Admin' ";
            mysqli_query($conn, $sqlQuery);
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer.php');
        exit();
    }
    
?>
