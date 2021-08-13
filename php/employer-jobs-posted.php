<?php

    require('../php-config/database.php');

    $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);

    $employerJobPostingsQuery = "SELECT DISTINCT job.job_ID, job.employer_ID, job.title FROM job WHERE job.employer_ID = (SELECT user.employer_ID FROM user WHERE user.username='$employer') ORDER BY job.job_ID";

    $employerJobPostingQueryResults = mysqli_query($conn, $employerJobPostingsQuery);

    $jobIDResults = array();
    $employerIDResults = array();
    $jobNameResults = array();
    
    while ($row = $employerJobPostingQueryResults->fetch_assoc()) {

        array_push($jobIDResults, $row['job_ID']);
        array_push($employerIDResults, $row['employer_ID']);
        array_push($jobNameResults, $row['title']);
    }

    $_SESSION['employerJobPostingQueryResults'] = $employerJobPostingQueryResults;
    $_SESSION['postedJobIDResultsArray'] = $jobIDResults;
    $_SESSION['postedEmployerIDResultsArray'] = $employerIDResults;
    $_SESSION['postedJobNameResultsArray'] = $jobNameResults;

    require('../php-config/close-database.php');
?>