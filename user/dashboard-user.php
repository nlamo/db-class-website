<?php
    session_start();

    // gets all of the jobs in the database
    require('../php/search-all-jobs.php');

    // gets all jobs of a specific category type
    require('../php/search-jobs-by-category.php');

    // gets all jobs of a specific job title/name
    require('../php/search-jobs-by-name.php');

    // to apply for a job
    require('../php/apply-for-job.php');

    // for changing the status of the user (active/inactive)
    require('../php/maintain-application-status.php');

    // to remove an application the user has submitted
    require('../php/withdraw-application.php');

    // for updating a user's category only if s(he) is not admin
    require('../php/upgrade-user-category.php');

    // for updating a user's profile (admin is permitted)
    require('../php/update-user-profile.php');

    // to delete your user account
    require('../php/delete-user-account.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grid-user.css">
    <script src="../js/script.js" defer></script>
    <title>User Dashboard</title>
</head>
<body>

    <!-- First (1st) User Container/Dashboard -->
    <div class="dashboard-container">
        <h3>User Dashboard</h3><br>

        <a href="#">
            <button class="contact-button" onclick="alertBox('Having some difficulties?\n\nJust scroll down to the second panel.\n\nIn the leftmost column, you\'ll find contact information and some helpful guidelines.')">
                Need Help? Contact Us.
            </button>
        </a>
        
        <form method="POST" action="">
            <a href="#">
                <button class="search-all-jobs" name="search-all-jobs">
                    Search All Jobs!
                </button>
            </a> 
        </form> 

        <div class="dashboard-user">
         
            <!-- TODO: Allow user to simply get all the jobs (full search) -->
            <!-- TODO: Requests for data, will be output by job-data > textarea -->
            <div class="search-jobs-by-category">

                <form method="POST" action="">
                    <h4>Search By Category</h4><br><br>
                    <small>Please enter the category of the jobs you're looking for:</small><br><br>

                    <label>Job Category</label><br>
                    <input type="job-category" id="job-category" name="job-category">
            
                    <button type="submit" class="button" name="search-jobs-by-category">Search</button><br>
                </form> 

            </div>

            <div class="search-jobs-by-name">

                <form method="POST" action="">
                    <h4>Search By Name</h4><br><br>
                    <small>Please enter the name of the jobs you're looking for:</small><br><br>

                    <label>Job Name</label><br>
                    <input type="job-name" id="job-name" name="job-name">

                    <button type="submit" class="button" name="search-jobs-by-name">Search</button><br>
                </form> 

            </div>

            <!-- TODO: Job data retrieved from MySQL DB will be output here -->
            <div class="job-data">
                <form>
                    <h4>Job Data</h4><br><br>

                    <p name="job-data" id="job-data">
                     
                        <!-- USER: searched for all jobs -->
                        <?php if (isset($_SESSION['searchedForJobs'])): ?>

                            <?php foreach ($_SESSION['jobIDResultsArray'] as $entry): ?>
                                
                                <!-- NOTE: Previously used a counter, but this would be inadequate if a given job (vis-a-vis job_ID) were to be removed, so $entry - 1 works better, for now at least... -->

                                <?php 
                                    echo 'Job ID: ' . $entry . '<br>';
                                    echo 'Employer ID: ' . $_SESSION['employerIDResultsArray'][$entry - 1 ] . '<br>';
                                    echo 'Job Category: ' . $_SESSION['jobCategoryResultsArray'][$entry - 1] . '<br>';
                                    echo 'Title: ' . $_SESSION['jobTitleResultsArray'][$entry - 1] . '<br>';
                                    echo 'Salary: ' . $_SESSION['jobSalaryResultsArray'][$entry - 1] . '<br><br>';
                                    echo 'Job Description: ' . $_SESSION['jobDescriptionResultsArray'][$entry - 1] . '<br><br>';
                                    echo 'Start Date: ' . $_SESSION['startDateResultsArray'][$entry - 1] . '<br>';
                                    echo '<br>------------------------------------------------<br>';
                                ?>

                                <br>

                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- USER: searched jobs by category -->
                        <?php if (isset($_SESSION['searchedJobsByCategory'])): ?>

                            <?php $counter = 0; ?>

                            <?php foreach ($_SESSION['jobIDResultsArray'] as $entry): ?>

                                <?php 
                                    echo 'Job ID: ' . $entry . '<br>';
                                    echo 'Employer ID: ' . $_SESSION['employerIDResultsArray'][$counter] . '<br>';
                                    echo 'Job Category: ' . $_SESSION['jobCategoryResultsArray'][$counter] . '<br>';
                                    echo 'Title: ' . $_SESSION['jobTitleResultsArray'][$counter] . '<br>';
                                    echo 'Salary: ' . $_SESSION['jobSalaryResultsArray'][$counter] . '<br><br>';
                                    echo 'Job Description: ' . $_SESSION['jobDescriptionResultsArray'][$counter] . '<br><br>';
                                    echo 'Start Date: ' . $_SESSION['startDateResultsArray'][$counter] . '<br>';
                                    echo '<br>------------------------------------------------<br>';

                                    $counter++;
                                ?>

                                <br>

                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- USER: searched jobs by name -->
                        <?php if (isset($_SESSION['searchedJobsByName'])): ?>

                            <?php $counter = 0; ?>

                            <?php foreach ($_SESSION['jobIDResultsArray'] as $entry): ?>

                                <?php 
                                    echo 'Job ID: ' . $entry . '<br>';
                                    echo 'Employer ID: ' . $_SESSION['employerIDResultsArray'][$counter] . '<br>';
                                    echo 'Job Category: ' . $_SESSION['jobCategoryResultsArray'][$counter] . '<br>';
                                    echo 'Title: ' . $_SESSION['jobTitleResultsArray'][$counter] . '<br>';
                                    echo 'Salary: ' . $_SESSION['jobSalaryResultsArray'][$counter] . '<br><br>';
                                    echo 'Job Description: ' . $_SESSION['jobDescriptionResultsArray'][$counter] . '<br><br>';
                                    echo 'Start Date: ' . $_SESSION['startDateResultsArray'][$counter] . '<br>';
                                    echo '<br>------------------------------------------------<br>';

                                    $counter++;
                                ?>

                                <br>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                </form>
            </div>
     
            <div class="apply-for-job">

                <form method="POST" action="">
                    <h4>Apply for a Job</h4><br><br>
            
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name="job-id">

                    <br><br><br>
                
                    <label>Application</label><br>
                    <textarea id="application" name="application-text" cols="28" rows="17" style="margin-top:10px;"></textarea>
            
                    <button type="submit" class="button" name="apply-for-job" style="width:260px;">Submit Application</button><br>
                </form>
                
            </div>

            <div class="maintain-status">

                <form method="POST" action="">
                    <h4>Maintain Status</h4><br><br>
                    <small>Set application to active or inactive:</small><br><br>
                    
                    <label><strong>Job Application ID</strong></label><br>
                    <input type="text" id="job-application-id" name="job-application-id"><br>

                    <label>Status</label><br>
                    <input type="text" id="application-status" name="application-status">

                    <button type="submit" class="button" name="update-status">Update Status</button><br>
                </form>
            </div>

            <div class="withdraw-application">

                <form method="POST" action="">
                    <h4>Withdraw Application</h4><br><br><br>

                    <label><strong>Job Application ID</strong></label><br>
                    <input type="text" id="job-application-id" name="job-application-id">
        
                    <button type="submit" class="button" name="withdraw-application">Withdraw</button><br>
                </form>
            </div>

        </div>
    </div>


    <br><br><br> 


     <!-- Second (2nd) User Container/Dashboard -->
     <div class="dashboard-container">

        <div class="dashboard-user">

            <div class="help-and-contact">

                <h4>Help and Contact</h4><br><br>

                <div class="help-wrapper">

                    <small>'Search by Category' and 'Search by Name' allow for searching for jobs by category and name, respectively. Output is in the 'Job Data' textbox.</small>

                    <br><br>

                    <small>As an regular user/job hunter, you are able to easily change between 'Basic', 'Prime', and 'Gold' accounts. The default is 'Basic'.</small>

                    <br><br>

                    <small>In the top panel, you can easily apply for a new job.</small>

                    <br><br>

                    <small>To maintain the status of a given job you've applied for, you can easily set the job status to 'active' or 'inactive'.</i></small>

                    <br><br>

                    <small>To withdraw a specific application, you need only enter the ID of the job you applied for, as well as the application number.</small>

                    <br><br>

                    <small>Questions? Please feel free to reach out:</small>

                    <br><br>

                    <small>n_lamo@encs.concordia.ca</small>
                    <small>f_attia@encs.concordia.ca</small>

                </div>
            </div>

            <div class="user-categories">

                <form method="POST" action="">
                    <h4>User Category</h4><br><br>

                    <small>Want more functionality? Upgrade!</small><br><br>

                    <small> <i>You really should just upgrade.</i> There's not a lot you can really do unless you go 'Prime', so do that, at a minimum.</small> 

                    <button type="submit" class="button" style="background:grey;" onclick="alertBox('You have changed your subscription to basic.\n\nYou can view all of the jobs but you cannot apply.\n\nThis subscription is free.')" name="subscribe-to-basic">
                        BASIC
                    <button type="submit" class="button" style="background:rgb(67, 101, 165);" onclick="alertBox('You have changed your subscription to prime!\n\nYou can now view all jobs and apply for up to five (5) jobs.\n\nYou will be charged $10 per month. Feel free to cancel anytime.')" name="subscribe-to-prime">
                        PRIME
                    </button>
                    <button type="submit" class="button" style="background:rgb(216, 188, 32);" onclick="alertBox('You have changed your subscription to gold!\n\nYou can now view all jobs and apply for an unlimited number of jobs.\n\nYou will be charged $20 per month. Feel free to cancel anytime.')" name="subscribe-to-gold">
                        GOLD
                    </button>      
                </form>
            </div>
                
            <div class="update-user-profile">
                <form method="POST" action="">
                    <h4>Update User Profile</h4><br><br>

                    <br>
                    
                    <label>First Name</label><br>
                    <input type="first-name" name="first-name"><br><br>

                    <label>Last Name</label><br>
                    <input type="last-name" name="last-name"><br><br>

                    <label>E-mail</label><br>
                    <input type="email" name="email"><br><br>

                    <label>Password</label><br>
                    <input type="password" name="password"><br><br>

                    <label>Security Question:</label><br>
                    <div class="security-question">What is your favourite film of<br> all time?</div>
        
                    <input type="text" name="security-answer"><br><br>

                    <button type="submit" class="button" style="width:260px;" name="update-user-profile">Update Profile</button><br>
                </form>
            </div>

            
            <div class="delete-user-account" style="height: 607px;">

                <form method="POST" action="">
                    <h4>Delete User Account</h4><br><br>

                    <small>Are you <i>absolutely 100% certain that you really, truly wish to delete your precious user account? If you do choose to walk this dark path - that is, account deletion - then you should know that there is no turning back. This action is completely irrevocable.</i></small><br><br>

                    <small>Basically, it will be as if you had never existed. We will miss you, but know that on life's path - during this great journey, where many follies are committed, and much anxiety and anomie subsumed under the assumption of personal validation and identification - there is always the opportunity for recourse, for redemption.</small><br><br>

                    <small>What we mean to say is, er, that you're always welcome back if you discover your true path.</small><br><br><br>

                    <label>Enter 'Yes' to Delete Account</label><br>
                    <input type="text" name="confirm-decision" style="margin-top: 15px;"><br><br>

                    <button type="submit" class="button" name="delete-account">Delete Account</button><br>
                </form>
                
            </div>
            
        </div>
    </div>

    <br><br><a href="./index.php">Return to User Login</a><br><br>
</body>
</html>