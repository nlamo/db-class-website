<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // TODO: Almost 100% - just needs to maintain the previous date posted, as the default
    //       date for HTML is the start of the epoch. Checking if it's 'empty' is useless,
    //       as it will never be empty

    if (isset($_POST['update-job'])) {

        require('../php-config/database.php');


        if (!($_SESSION['hasFrozenAccount'])) 
        {
            $jobID = mysqli_real_escape_string($conn, $_POST['job-id']);
            $employerID = mysqli_real_escape_string($conn, $_POST['employer-id']);
            $jobCategory = mysqli_real_escape_string($conn, $_POST['job-category']);
            $jobTitle = mysqli_real_escape_string($conn, $_POST['job-title']);
            $salaryPosted = mysqli_real_escape_string($conn, $_POST['salary']);
            $descriptionPosted = mysqli_real_escape_string($conn, $_POST['job-description']);

            // convert date to timestamp
            $dateTimestamp = strtotime($_POST['start-date']);

            // convert date to MySQL-complaint format
            $dateYMD = date("Y-m-d H:i:s", $dateTimestamp);

            $datePosted = mysqli_real_escape_string($conn, $dateYMD);

            // NOTE: We are not changing job_ID! That should, of course, remain the same.

            // NOTE: This 'logic' is fine for the time being, but realistically, there is an issue. If one of the queries returns false, and sets the SESSION variable, it can still by overriden by a successful query to follow. Since there's only one alert() that is triggered, this could produce a 'false positive' of sorts. Nevertheless, all of the queries are working.
            
            if (!empty($employerID) || !empty($jobCategory) || !empty($jobTitle) || !empty($salaryPosted) || !empty($descriptionPosted)) 
            {

                if (!empty($employerID)) {
                    $sqlQuery = "UPDATE job SET job.employer_ID='$employerID' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
                }
    
                if (!empty($jobCategory)) {
                    $sqlQuery = "UPDATE job SET job.job_category='$jobCategory' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
                }
    
                if (!empty($jobTitle)) {
                    $sqlQuery = "UPDATE job SET job.title='$jobTitle' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
                }
    
                if (!empty($salaryPosted)) {
                    $sqlQuery = "UPDATE job SET job.salary='$salaryPosted' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
                }
    
                if (!empty($descriptionPosted)) {
                    $sqlQuery = "UPDATE job SET job.description='$descriptionPosted' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
                }
    
                if (!empty($datePosted)) {
                    $sqlQuery = "UPDATE job SET job.date_start='$datePosted' WHERE job_ID='$jobID'";
                    
                    if (mysqli_query($conn, $sqlQuery)) {
                        $_SESSION['querySuccessful'] = true;
                    }
                    else {
                        $_SESSION['querySuccessful'] = false;
                    }
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
