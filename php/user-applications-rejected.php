<!-- NOTE: There are other cases of retrievals like this where I'm using SESSION
           variables and they are in fact totally redundant (and cumbersome). 
           It might be worth refactoring these in the future
-->
<?php

    require('../php-config/database.php');

    $user = mysqli_real_escape_string($conn, $_SESSION['user']);

    $userApplicationsRejectedQuery = "SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.username, job_application.application_response FROM job_application WHERE job_application.username = '$user' AND job_application.application_status = 'rejected' ";

    $userApplicationsRejectedResult = mysqli_query($conn, $userApplicationsRejectedQuery);

    $rejectedJobApplicationIDResults = array();
    $rejectedJobIDResults = array();
    $rejectedJobNameResults = array();
    $rejectedUsernameResults = array();
    $rejectedApplicationResponseResults = array();

    while ($row = $userApplicationsRejectedResult->fetch_assoc()) {

        array_push($rejectedJobApplicationIDResults, $row['job_application_ID']);
        array_push($rejectedJobIDResults, $row['job_ID']);
        array_push($rejectedJobNameResults, $row['job_name']);
        array_push($rejectedUsernameResults, $row['username']);
        array_push($rejectedApplicationResponseResults, $row['application_response']);
    }

    require('../php-config/close-database.php');
?>