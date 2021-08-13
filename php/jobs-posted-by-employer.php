<?php

    require('../php-config/database.php');

    $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);

    $applicationsToEmployerQuery = "SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.employer_name FROM job_application, user WHERE job_application.employer_ID = (SELECT user.employer_ID FROM user WHERE user.username='$employer')";

    $applicationsToEmployerResults = mysqli_query($conn, $applicationsToEmployerQuery);

    $jobApplicationIDResults = array();
    $jobIDResults = array();
    $jobNameResults = array();
    $employerNameResults = array();

    while ($row = $applicationsToEmployerResults->fetch_assoc()) {

        array_push($jobApplicationIDResults, $row['job_application_ID']);
        array_push($jobIDResults, $row['job_ID']);
        array_push($jobNameResults, $row['job_name']);
        array_push($employerNameResults, $row['employer_name']);
    }

    $_SESSION['jobApplicationIDResultsArray'] = $jobApplicationIDResults;
    $_SESSION['jobIDResultsArray'] = $jobIDResults;
    $_SESSION['jobNameResultsArray'] = $jobNameResults;
    $_SESSION['employerNameResultsArray'] = $employerNameResults;
 
    require('../php-config/close-database.php');
?>