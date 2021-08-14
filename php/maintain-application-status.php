<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['update-status'])) {

        require('../php-config/database.php');


        if (!($_SESSION['hasFrozenAccount'])) {

            $jobApplicationID = mysqli_real_escape_string($conn, $_POST['job-application-id']);
            $user = mysqli_real_escape_string($conn, $_SESSION['user']);
            $applicationStatus = mysqli_real_escape_string($conn, $_POST['application-status']);


            // Both fields required to update an application
            // It will only update the application if the user is a match for that given ID
            if (!empty($jobApplicationID) && !empty($applicationStatus) )
            {
                $sqlQuery = "UPDATE job_application SET job_application.application_status='$applicationStatus' WHERE (job_application.job_application_ID='$jobApplicationID' AND job_application.username='$user')";
         
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
        }


        require('../php-config/close-database.php');
        header('Location: dashboard-user.php');
        exit();
    }
?>
