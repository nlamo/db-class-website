<?php

    require('../php-config/database.php');

    $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);

    $applicationsAcceptedQuery = "SELECT DISTINCT job_application.job_application_ID, job_application.username, job_application.job_ID, job_application.employer_name FROM job_application WHERE job_application.employer_ID = (SELECT user.employer_ID FROM user WHERE user.username='$employer') AND job_application.application_status = 'accepted' ";

    $applicationsAcceptedResults = mysqli_query($conn, $applicationsAcceptedQuery);

    $jobApplicationIDResults = array();
    $jobIDResults = array();
    $usernameResults = array();
    $employerNameResults = array();

    while ($row = $applicationsAcceptedResults->fetch_assoc()) {
        
        array_push($jobApplicationIDResults, $row['job_application_ID']);
        array_push($jobIDResults, $row['job_ID']);
        array_push($usernameResults, $row['username']);
        array_push($employerNameResults, $row['employer_name']);
    }

    $_SESSION['acceptedJobApplicationIDResultsArray'] = $jobApplicationIDResults;
    $_SESSION['acceptedJobIDResultsArray'] = $jobIDResults;
    $_SESSION['acceptedUsernameResultsArray'] = $usernameResults;
    $_SESSION['acceptedEmployerNameResultsArray'] = $employerNameResults;

    require('../php-config/close-database.php');
?>