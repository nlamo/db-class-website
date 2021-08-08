
<?php
     require('../php-config/database.php');

     if (isset($_SESSION['isAdmin'])) 
     {

          // For a loggin-in 'admin' user, the most recent application out of *all*
          // job applications will be displayed

          $applicationIdQuery = "SELECT job_application_ID FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

          $applicationUsernameQuery = "SELECT username FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";
     
          $applicantFirstNameQuery = "SELECT user.first_name FROM user, job_application WHERE (user.username = job_application.username) AND job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";
     
          $applicantLastNameQuery = "SELECT user.last_name FROM user, job_application WHERE (user.username = job_application.username) AND job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";
     
          $applicationJobIdQuery = "SELECT job_ID FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

          $applicationJobNameQuery = "SELECT job_name FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";

          $applicationEmployerNameQuery = "SELECT employer_name FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";
     
          $applicationTextQuery = "SELECT application_text FROM job_application WHERE job_application_ID = (SELECT MAX(job_application_ID) FROM job_application)";
     }
     else 
     {
          // For a logged-in 'employer' user, the most recent application for that
          // individual's business will be displayed
          $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);
          
          $applicationIdQuery = "SELECT job_application.job_application_ID FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";

          $applicationUsernameQuery = "SELECT job_application.username FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";

          $applicantFirstNameQuery = "SELECT user.first_name FROM user, job_application WHERE user.username = job_application.username AND job_application_ID = (SELECT job_application.job_application_ID FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1)";

          $applicantLastNameQuery = "SELECT user.last_name FROM user, job_application WHERE user.username = job_application.username AND job_application_ID = (SELECT job_application.job_application_ID FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1)";

          $applicationJobIdQuery = "SELECT job_application.job_ID FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";

          $applicationJobNameQuery = "SELECT job_application.job_name FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";

          $applicationEmployerNameQuery = "SELECT job_application.employer_name FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";

          $applicationTextQuery = "SELECT job_application.application_text FROM job_application, user WHERE job_application.employer_ID = user.employer_ID AND user.username='$employer' ORDER BY job_application.job_application_ID DESC LIMIT 0, 1";
     }

     $applicationIdResult = mysqli_query($conn, $applicationIdQuery);
     $applicationUsernameResult = mysqli_query($conn, $applicationUsernameQuery);
     $applicantFirstNameResult = mysqli_query($conn, $applicantFirstNameQuery);
     $applicantLastNameResult = mysqli_query($conn, $applicantLastNameQuery);
     $applicationJobIdResult= mysqli_query($conn, $applicationJobIdQuery);
     $applicationJobNameResult = mysqli_query($conn, $applicationJobNameQuery);
     $applicationEmployerNameResult = mysqli_query($conn, $applicationEmployerNameQuery);
     $applicationTextResult = mysqli_query($conn, $applicationTextQuery);
    
    // NOTE: This is for testing. Comment out when finished.

    //  if ( ($applicationIdResult && $applicationUsernameResult && $applicationJobIdResult && $applicationJobNoResult && $applicationTextResult) == false) {
    //     echo 'Query submission error: ' . mysqli_error($conn) . ' ';
    //  } 
    //  else {
    //     echo 'Query successful.';
    //  }

     require('../php-config/close-database.php');
?>