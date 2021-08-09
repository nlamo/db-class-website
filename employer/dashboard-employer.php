<?php
    session_start();
    
    // for outputting most recent application to the application-summary textarea
    require('../php/get-current-application.php');

    // for posting a job
    require('../php/post-job.php');

    // for updating a job
    require('../php/update-job.php');

    // for updating a user's category only if s(he) is not admin
    require('../php/maintain-user.php');

    // for updating an employer's category only if s(he) is not admin
    require('../php/upgrade-employer-category.php');

    // for updating an application (accepting/rejecting) and providing a response to applicant
    require('../php/update-application.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grid-employer.css">
    <script src="../js/script.js" defer></script>
    <title>Employer Dashboard</title>
</head>
<body>

    <!-- First (1st) Employer Container/Dashboard -->
    <div class="dashboard-container">
        <h3>Employer Dashboard</h3><br>

        <a href="#">
            <button class="contact-button" onclick="alertBox('Having some difficulties?\n\nJust scroll down to the second panel.\n\nIn the leftmost column, you\'ll find contact information and some helpful guidelines.')">
                Need Help? Contact Us.
            </button>
        </a> 

        <div class="dashboard-employer">
        
            <!-- For adminstrators to update the properties of given users -->
            <form method="POST" action="">
                
                <div class="maintain-users">
                    <h4>User Maintenance</h4><br><br>

                    <small>This is where you can update the user category of a given user (unless the user is admin).</small><br><br>

                    <div>
                        <label><strong>Username</strong></label><br>
                        <input type="text" id="username" name="user">
                    </div>
                    <div>
                        <label>User Category</label><br>
                        <input type="text" id="user-type" name ="user-category">
                    </div>

                    <button type="submit" class="button" name="maintain-submit">
                        Submit
                    </button>
                </div>

            </form>

            <!-- For employers to upgrade or downgrade their category -->
            <form method="POST" action="">

                <div class="employer-categories">
                    <h4>Employer Category</h4><br><br>

                    <small>Want more functionality? Upgrade!</small> 

                    <!-- TODO: Probably will want to give these IDs for the control logic that will be implemented -->
                    <button type="submit" class="button" style="background:rgb(67, 101, 165);" onclick="alertBox('You have changed your subscription to prime!\n\nYou can now post up to five (5) jobs.\n\nYou will be charged $50 per month. Feel free to cancel anytime.')" name="subscribe-to-prime">
                        PRIME
                    </button>
                    <button type="submit" class="button" style="background:rgb(216, 188, 32);" onclick="alertBox('You have changed your subscription to gold!\n\nYou can now post an unlimited number of jobs.\n\nYou will be charged $100 per month. Feel free to cancel anytime.')" name="subscribe-to-gold">
                        GOLD
                    </button>
                </div>

            </form>
     
            <!-- For employers to create job postings -->
            <div class="post-jobs">
                <h4>Post Job</h4><br><br>

                <!-- FORM: Post a job -->
                <form method="POST" action="">

                    <div class="post-jobs-subgrid">
                        
                        <div>
                            <label><strong>Job ID</strong></label><br>
                            <input type="text" id="job-id" name="job-id">
                        </div>
                        <div>
                            <label>Employer ID</label><br>
                            <input type="text" id="employer-id" name="employer-id">
                        </div>
                        <div>
                            <label>Job Category</label><br>
                            <input type="text" id="job-category" name="job-category">
                        </div>
                        <div>
                            <label>Job Title</label><br>
                            <input type="text" id="job-title" name="job-title">
                        </div>
                        <div>
                            <label>Salary</label><br>
                            <input type="text" id="salary" name="salary">
                        </div>
                        <div>
                            <label>Start Date</label><br>
                            <input type="date" id="start-date" name="start-date">
                        </div>
                        <div id="job-description-container">
                            <label>Job Description</label><br>
                            <textarea name="job-description" id="job-description" cols="30" rows="10"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="button" name="submit-job">Post Job</button><br>
                    </div>
                </form>
                
            </div>

            <!-- A summary of the current (most recent) application for any given job -->
            <div class="application-summary">
                <h4>Current Application Summary</h4><br><br>

                <p name="application-summary" id="application-summary" cols="34" rows="31">

                    <?php while ($row = $applicationIdResult->fetch_assoc() ): ?>
                        
                        <?php
                            echo 'Application ID: ';
                            echo $row['job_application_ID'] . '<br><br>';
                        ?>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicationUsernameResult->fetch_assoc() ): ?>
                        
                        <?php 
                            echo 'Username: ';
                            echo $row['username'] . '<br>';
                        ?><br>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicantFirstNameResult->fetch_assoc() ): ?>
                        
                        <?php 
                            echo 'First name: ';
                            echo $row['first_name'] . '<br>';
                        ?><br>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicantLastNameResult->fetch_assoc() ): ?>
                        
                        <?php 
                            echo 'Last name: ';
                            echo $row['last_name'] . '<br><br>';
                            echo '------------------------<br>';
                        ?><br>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicationJobIdResult->fetch_assoc() ): ?>
                        
                        <?php
                            echo 'Job ID: ';
                            echo $row['job_ID'] . '<br><br>';
                        ?>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicationEmployerNameResult->fetch_assoc() ): ?>
                        
                        <?php
                            echo 'Employer Name: ';
                            echo $row['employer_name'] . '<br><br>';
                        ?>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicationJobNameResult->fetch_assoc() ): ?>
                        
                        <?php
                            echo 'Job Name: ';
                            echo $row['job_name'] . '<br><br>';
                        ?>
                
                    <?php endwhile; ?>

                    <?php while ($row = $applicationTextResult->fetch_assoc() ): ?>
                    
                        <?php 
                            echo 'Application Content: ' . '<br><br>';
                            echo $row['application_text'];
                        ?><br>
                    
                    <?php endwhile; ?>

                </p>
            </div>
        </div>
    </div>

    <br><br><br> 

    <!-- Second (2nd) Employer Container/Dashboard -->
    <div class="dashboard-container">
        <div class="dashboard-employer">

            <div class="help-and-contact" style="height: 650px;">

            <h4>Help and Contact</h4><br><br>

                <div class="help-wrapper">
        
                    <small>The 'User Maintenance' section only allows you to change the user type, as this is a div of administrative permissions control.</small>

                    <br><br>

                    <small>As an employer, you are able to easily change between 'Prime' and 'Gold' accounts. The default is 'Prime'.</small>

                    <br><br>

                    <small>In the top panel, you can post a new job. In the bottom panel, you can update any of the attributes of a posted job.</small>

                    <br><br>

                    <small>The 'Current Application Summary' will simply display the information of the <i>most recently submitted application.</i></small>

                    <br><br>

                    <small>Finally, on the rightmost column of this panel, you can update an application status and provide a brief letter to the applicant.</small>

                    <br><br>

                    <small>Questions? Please feel free to reach out:</small>

                    <br><br>

                    <small>n_lamo@encs.concordia.ca</small>
                    <small>f_attia@encs.concordia.ca</small>

                </div>
            </div>

            <!-- NOTE: This is *exactly* the same as `post-jobs`, but the class names
                       have been changed to lessen the chance of weird interdependencies 
                       if anything needs to change in the future. -->

            <div class="update-jobs" style="height: 650px;">
                <h4>Update Job</h4><br><br>

                <!-- FORM: Update a job -->
                <form method="POST" action="">

                    <div class="update-jobs-subgrid">
                                    
                        <div>
                            <label><strong>Job ID</strong></label><br>
                            <input type="text" id="job-id" name="job-id">
                        </div>
                        <div>
                            <label>Employer ID</label><br>
                            <input type="text" id="employer-id" name="employer-id">
                        </div>
                        <div>
                            <label>Job Category</label><br>
                            <input type="text" id="job-category" name="job-category">
                        </div>
                        <div>
                            <label>Job Title</label><br>
                            <input type="text" id="job-title" name="job-title">
                        </div>
                        <div>
                            <label>Salary</label><br>
                            <input type="text" id="salary" name="salary">
                        </div>
                        <div>
                            <label>Start Date</label><br>
                            <input type="date" id="start-date" name="start-date">
                        </div>
                        <div id="job-description-container">
                            <label>Job Description</label><br>
                            <textarea name="job-description" id="job-description" cols="30" rows="13"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="button" name="update-job">Update Job</button><br>
                    </div>
                </form>
            </div>

            <form method="POST" action="">

                <!-- So that the employer can maintain/update job applications -->
                <div class="update-applications" style="height: 650px;">
                    <h4>Update Application</h4><br><br>

                    <div>
                        <label><strong>Job Application ID</strong></label><br>
                        <input type="text" id="job-application-id" name="job-application-id">
                    </div>
                    <div>
                        <label><strong>Job ID</strong></label><br>
                        <input type="text" id="job-id" name="job-id">
                    </div>
                    <div>
                        <label><strong>Username</strong></label><br>
                        <input type="text" id="user-id" name="user">
                    </div>
                    <div>
                        <label>Application Status</label><br>
                        <input type="text" id="user-id" name="application-status">
                    </div>

                    <br>

                    <div>
                        <label>Message to Applicant</label><br>
                        <textarea id="message-to-applicant" name="message-to-applicant" cols="34" rows="13"></textarea>
                    </div>

                    <button type="submit" class="button" name="update-application">Update Application</button><br>
                </div>

            </form>

        </div>
    </div>

    <br><br><a href="./index.php">Return to Employer Login</a><br><br>
</body>
</html>

<?php
    
?>