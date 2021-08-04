<?php
     require('../php-config/database.php');

     // Nested queries that will get application_ID for the highest (MAX)
     // job_application_ID, which is to say, the most recent submission

     $applicationIdQuery = "SELECT job_application_ID FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

     $applicationUsernameQuery = "SELECT username FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

     $applicationJobIdQuery = "SELECT job_ID FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

     $applicationJobNoQuery = "SELECT application_no FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

     $applicationTextQuery = "SELECT application_text FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

     $applicationIdResult = mysqli_query($conn, $applicationIdQuery);
     $applicationUsernameResult = mysqli_query($conn, $applicationUsernameQuery);
     $applicationJobIdResult= mysqli_query($conn, $applicationJobIdQuery);
     $applicationJobNoResult= mysqli_query($conn, $applicationJobNoQuery);
     $applicationTextResult = mysqli_query($conn, $applicationTextQuery);
    
   // NOTE: This is for testing. Comment out when completely done.

   //   if ( ($applicationIdResult && $applicationUsernameResult && $applicationJobIdResult && $applicationJobNoResult && $applicationTextResult) == false) {
   //      echo 'Query submission error: ' . mysqli_error($conn) . ' ';
   //   } 
   //   else {
   //      echo 'Query successful.';
   //   }

     require('../php-config/close-database.php');
?>