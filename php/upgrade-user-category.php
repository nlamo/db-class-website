<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php
    
    // You can change any category *except for* admin
    
    if (isset($_POST['subscribe-to-basic'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_SESSION['user']);

        $sqlQuery = "UPDATE user SET user.user_category='User Basic' WHERE user.username='$user' AND user.user_category LIKE 'User%' ";

        mysqli_query($conn, $sqlQuery);
  
        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }

    if (isset($_POST['subscribe-to-prime'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_SESSION['user']);

        $sqlQuery = "UPDATE user SET user.user_category='User Prime' WHERE user.username='$user' AND user.user_category LIKE 'User%' ";

        mysqli_query($conn, $sqlQuery);
  
        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }

    if (isset($_POST['subscribe-to-gold'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_SESSION['user']);

        $sqlQuery = "UPDATE user SET user.user_category='User Gold' WHERE user.username='$user' AND user.user_category LIKE 'User%' ";

        mysqli_query($conn, $sqlQuery);

        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }

?>