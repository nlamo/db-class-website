<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['withdraw-application'])) {

        require('../php-config/database.php');

        if (!($_SESSION['hasFrozenAccount'])) 
        {

            $jobApplicationID = mysqli_real_escape_string($conn, $_POST['job-application-id']);
            $user = mysqli_real_escape_string($conn, $_SESSION['user']);

            // Sets all of the values to NULL, rendering it useless
            if (!empty($jobApplicationID) && !empty($user))
            {
                $sqlQuery = "UPDATE job_application SET username=NULL, job_ID=NULL, job_name=NULL, employer_ID=NULL, employer_name=NULL, application_text=NULL, application_status=NULL, application_response=NULL WHERE (job_application.job_application_ID='$jobApplicationID' AND job_application.username='$user')";
          
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
