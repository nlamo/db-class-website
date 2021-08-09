<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // TODO: Make sure that a session variable is set that will then trigger a message
    //       to the user after the redirect!

    // TODO: Add further validation in case fields are empty
    
    if (isset($_POST['apply-for-job'])) {


        if (isset($_POST['job-id']) && isset($_POST['application-text'])) 
        {

            require('../php-config/database.php');

            $user = mysqli_real_escape_string($conn, $_SESSION['user']);
            $jobID = mysqli_real_escape_string($conn, $_POST['job-id']);
            $applicationText = mysqli_real_escape_string($conn, $_POST['application-text']);
    
            // getting some other values, then I need to make them ready for final query
            $jobNameQuery = "SELECT job.title AS jobName FROM job WHERE job.job_ID = '$jobID'";
            $employerIDQuery = "SELECT job.employer_ID AS employerID FROM job, employer WHERE job.employer_ID = employer.employer_ID AND job.job_ID = '$jobID'";
            $employerNameQuery = "SELECT employer.name AS employerName FROM employer, job WHERE employer.employer_ID = job.employer_ID AND job.job_ID = '$jobID'";
    
            // Running the queries
            $jobName = mysqli_query($conn, $jobNameQuery);
            $employerID = mysqli_query($conn, $employerIDQuery);
            $employerName = mysqli_query($conn, $employerNameQuery);
    
            // Getting the rows as associative arrays...
            $jobNameRow = $jobName->fetch_assoc();
            $employerIDRow = $employerID->fetch_assoc();
            $employerNameRow = $employerName->fetch_assoc();
    
            // Getting the values from the arrays...
            $jobNameRowResult = $jobNameRow['jobName'];
            $employerIDRowResult = $employerIDRow['employerID'];
            $employerNameRowResult = $employerNameRow['employerName'];
    
            $sqlQuery = "INSERT INTO job_application (job_application_ID, username, job_ID, job_name, employer_ID, employer_name, application_text, application_status, application_response) VALUES (DEFAULT, '$user', '$jobID', '$jobNameRowResult', '$employerIDRowResult', '$employerNameRowResult', '$applicationText', 'active', '')";
    
    
            if (mysqli_query($conn, $sqlQuery)) {
                require('../php-config/close-database.php');
                header('Location: dashboard-user.php');
                exit();
            }
            else {
                require('../php-config/close-database.php');
                header('Location: dashboard-user.php');
                echo 'Query submission error: ' . mysqli_error($conn) . ' ';
                exit();
            }

        }
    }
?>