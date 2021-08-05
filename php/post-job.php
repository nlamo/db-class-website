<?php
    require('../php-config/database.php');


    // TODO: Make sure that a session variable is set that will then trigger a message
    //       to the user after the redirect!
    
    if (isset($_POST['submit-job'])) {

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

        $sqlQuery = "INSERT INTO job(job_ID, employer_ID, job_category, title, salary, description, date_start) VALUES ('$jobID', '$employerID', '$jobCategory', '$jobTitle', '$salaryPosted', '$descriptionPosted', '$datePosted')";


        if (mysqli_query($conn, $sqlQuery)) {
            require('../php-config/close-database.php');
            header('Location: dashboard-employer.php');
        }
        else {
            require('../php-config/close-database.php');
            echo 'Query submission error: ' . mysqli_error($conn) . ' ';
        }
    }

    require('../php-config/close-database.php');
?>