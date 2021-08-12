<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    if (isset($_POST['search-jobs-by-name'])) {
        
        require('../php-config/database.php');

        
        if ( !($_SESSION['hasFrozenAccount']) ) {

            // unset other variables related to job display
            unset($_SESSION['searchedForJobs']);
            unset($_SESSION['searchedJobsByCategory']);

            $jobName = mysqli_real_escape_string($conn, $_POST['job-name']);

            $searchedJobsByName = true;
            $jobsByNameQuery = "SELECT * FROM job WHERE job.title='$jobName'";
            $jobsByNameQueryResult = mysqli_query($conn, $jobsByNameQuery);

            // Arrays to store each of the properties for each job...
            // I am sure there's probably a better way to do this.

            $jobIDResultsArray = array();
            $employerIDResultsArray = array();
            $jobCategoryResultsArray = array();
            $jobTitleResultsArray = array();
            $jobSalaryResultsArray = array();
            $jobDescriptionResultsArray = array();
            $startDateResultsArray = array();    

            // Necessary to use fetch_assoc() or fetch_array() to get results before
            // having them stored in a SESSION variable for use on the webpage.

            while ($row = $jobsByNameQueryResult->fetch_assoc() ) {

                array_push($jobIDResultsArray, $row['job_ID']);
                array_push($employerIDResultsArray, $row['employer_ID']);
                array_push($jobCategoryResultsArray, $row['job_category']);
                array_push($jobTitleResultsArray, $row['title']);
                array_push($jobSalaryResultsArray, $row['salary']);
                array_push($jobDescriptionResultsArray, $row['description']);
                array_push($startDateResultsArray, $row['date_start']);
            }
            
            $_SESSION['searchedJobsByName'] = $searchedJobsByName;

            $_SESSION['jobIDResultsArray'] = $jobIDResultsArray;
            $_SESSION['employerIDResultsArray'] = $employerIDResultsArray;
            $_SESSION['jobCategoryResultsArray'] = $jobCategoryResultsArray;
            $_SESSION['jobTitleResultsArray'] = $jobTitleResultsArray;
            $_SESSION['jobSalaryResultsArray'] = $jobSalaryResultsArray;
            $_SESSION['jobDescriptionResultsArray'] = $jobDescriptionResultsArray;
            $_SESSION['startDateResultsArray'] = $startDateResultsArray;
        }


        require('../php-config/close-database.php');
        header("Location: dashboard-user.php");
        exit();
    }

?>