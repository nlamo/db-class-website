<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // TODO: Make sure that a session variable is set that will then trigger a message
    //       to the user after the redirect!

    // TODO: Add further validation in case fields are empty

    if (isset($_POST['submit-job'])) {

        require('../php-config/database.php');


        if (!($_SESSION['hasFrozenAccount']))
        {
            // job_ID is AUTO_INCREMENT and so it is given DEFAULT value
            $jobCategory = mysqli_real_escape_string($conn, $_POST['job-category']);
            $jobTitle = mysqli_real_escape_string($conn, $_POST['job-title']);
            $salaryPosted = mysqli_real_escape_string($conn, $_POST['salary']);
            $descriptionPosted = mysqli_real_escape_string($conn, $_POST['job-description']);

            $employerIDQuery = "SELECT employer_ID AS returnValue FROM user WHERE user.username='$employer'";

            $employerIDQueryReturn = mysqli_query($conn, $employerIDQuery);
            $employerIDRow = $employerIDQueryReturn->fetch_assoc();
            $employerID = $employerIDRow['returnValue'];
            $employerID = mysqli_real_escape_string($conn, $employerID);

            // convert date to timestamp
            $dateTimestamp = strtotime($_POST['start-date']);

            // convert date to MySQL-compliant format
            $dateYMD = date("Y-m-d H:i:s", $dateTimestamp);

            $datePosted = mysqli_real_escape_string($conn, $dateYMD);

            $sqlQuery = "INSERT INTO job(job_ID, employer_ID, job_category, title, salary, description, date_start) VALUES (DEFAULT, '$employerID', '$jobCategory', '$jobTitle', '$salaryPosted', '$descriptionPosted', '$datePosted')";

            if (mysqli_query($conn, $sqlQuery)) {
                $_SESSION['querySuccessful'] = true;
            }
            else {
                $_SESSION['querySuccessful'] = false;
            }

            require('../php-config/close-database.php');
            header('Location: dashboard-employer.php');
            exit();

        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer.php');
        exit();
    }
?>
