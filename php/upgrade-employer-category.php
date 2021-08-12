<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // You can change any category *except for* admin

    if (isset($_POST['subscribe-to-prime'])) {

        require('../php-config/database.php');

        if (!($_SESSION['hasFrozenAccount'])) 
        {
            $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);

            $sqlQuery = "UPDATE user SET user.user_category='Employer Prime' WHERE user.username='$employer' AND user.user_category LIKE 'Employer%' ";

            mysqli_query($conn, $sqlQuery);
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer.php');
        exit();
    }

    if (isset($_POST['subscribe-to-gold'])) {

        require('../php-config/database.php');

        if (!($_SESSION['hasFrozenAccount']))
        {
            $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);

            $sqlQuery = "UPDATE user SET user.user_category='Employer Gold' WHERE user.username='$employer' AND user.user_category LIKE 'Employer%' ";

            mysqli_query($conn, $sqlQuery);
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer.php');
        exit();
    }

?>
