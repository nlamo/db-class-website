<!-- NOTE: There are other cases of retrievals like this where I'm using SESSION
           variables and they are in fact totally redundant (and cumbersome). 
           It might be worth refactoring these in the future
-->
<?php

    require('../php-config/database.php');

    $user = mysqli_real_escape_string($conn, $_SESSION['user']);

    $userApplicationsAcceptedQuery = "SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.username, job_application.application_response FROM job_application WHERE job_application.username = '$user' AND job_application.application_status = 'accepted' ";

    $userApplicationsAcceptedResult = mysqli_query($conn, $userApplicationsAcceptedQuery);

    $acceptedJobApplicationIDResults = array();
    $acceptedJobIDResults = array();
    $acceptedJobNameResults = array();
    $acceptedUsernameResults = array();
    $acceptedApplicationResponseResults = array();

    while ($row = $userApplicationsAcceptedResult->fetch_assoc()) {

        array_push($acceptedJobApplicationIDResults, $row['job_application_ID']);
        array_push($acceptedJobIDResults, $row['job_ID']);
        array_push($acceptedJobNameResults, $row['job_name']);
        array_push($acceptedUsernameResults, $row['username']);
        array_push($acceptedApplicationResponseResults, $row['application_response']);
    }

    require('../php-config/close-database.php');
?>