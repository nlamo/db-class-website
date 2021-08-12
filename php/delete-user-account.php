<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // IMPORTANT: This is not a complete deletion, and it maintains the username.
    //            But there is good reason. If I chose to use ON CASCADE DELETE for
    //            child tables if I were to DELETE a given user account, then it would
    //            remove important records and potentially break the logic in some cases.
    //            As such, nullifying the user makes the most sense.

    if (isset($_POST['delete-account'])) {

        require('../php-config/database.php');

        $confirmDecision = htmlspecialchars($_POST['confirm-decision']);
        $theAffirmative = 'Yes';
        $user = mysqli_real_escape_string($conn, $_SESSION['user']);

        if ( (strcmp($confirmDecision, $theAffirmative) === 0) && !empty($user) ) 
        {
            $sqlQuery = "UPDATE user SET employer_ID=NULL, user_category=NULL, first_name=NULL, last_name=NULL, email=NULL, password=NULL, security_answer=NULL, total_jobs_posted=NULL, total_applications_submitted=NULL, status='inactive' WHERE user.username='$user'";

            mysqli_query($conn, $sqlQuery);
            require('../php-config/close-database.php');
            header('Location: index.php');
            exit();
        }
        else
        {
            // Print an error of some kind
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }
?>
