<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['update-application'])) {

        require('../php-config/database.php');

        
        if (!($_SESSION['hasFrozenAccount'])) {

            $jobApplicationID = mysqli_real_escape_string($conn, $_POST['job-application-id']);
            $applicationStatus = mysqli_real_escape_string($conn, $_POST['application-status']);
            $messageToApplicant = mysqli_real_escape_string($conn, $_POST['message-to-applicant']);


            if (!empty($jobApplicationID) && !empty($applicationStatus) && !empty($messageToApplicant))
            {
                $sqlQuery = "UPDATE job_application SET job_application.application_status='$applicationStatus', job_application.application_response='$messageToApplicant' WHERE (job_application.job_application_ID='$jobApplicationID')";

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
        header('Location: dashboard-employer.php');
        exit();
    }
?>
