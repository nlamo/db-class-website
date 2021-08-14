<!-- NOTE: There are other cases of retrievals like this where I'm using SESSION
           variables and they are in fact totally redundant (and cumbersome). 
           It might be worth refactoring these in the future
-->
<?php

    require('../php-config/database.php');

    $user = mysqli_real_escape_string($conn, $_SESSION['user']);

    $userApplicationsSentQuery = "SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.username FROM job_application WHERE job_application.username = '$user'";

    $userApplicationsSentResult = mysqli_query($conn, $userApplicationsSentQuery);

    $sentJobApplicationIDResults = array();
    $sentJobIDResults = array();
    $sentJobNameResults = array();
    $sentUsernameResults = array();

    while ($row = $userApplicationsSentResult->fetch_assoc()) {

        array_push($sentJobApplicationIDResults, $row['job_application_ID']);
        array_push($sentJobIDResults, $row['job_ID']);
        array_push($sentJobNameResults, $row['job_name']);
        array_push($sentUsernameResults, $row['username']);
    }

    require('../php-config/close-database.php');
?>