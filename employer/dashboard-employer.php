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
        <p><u><b>Employer Dashboard</b></u></p><br>

        <a href="#">
            <button class="contact-button" onclick="alertBox('Having some difficulties?\n\nJust scroll down to the second panel.\n\nIn the leftmost column, you\'ll find contact information and some helpful guidelines.')">
                Need Help? Contact Us.
            </button>
        </a> 

        <div class="dashboard-employer">
            
            <!-- For adminstrators to update the properties of given users -->
            <div class="maintain-users">
                <label><u>User Maintenance</u></label><br><br>

                <small>This is where you can update the user type of a given user.</small><br><br>

                <form>
                    <label><strong>Username</strong></label><br>
                    <input type="text" id="username" name="username">
                </form>
                <form>
                    <label>User Type</label><br>
                    <input type="text" id="user-type" name ="user-type">
                </form>

                <button type="submit" class="button" value="Update";>
                    Submit
                </button>
            </div>

            <!-- For adminstrators to upgrade or downgrade their category -->
            <!-- NOTE: Overriding the colours on the button classes used here -->
            <div class="employer-categories">
                <label><u>Employer Category</u></label><br><br>

                <small>Want more functionality? Upgrade!</small> 

                <!-- TODO: Probably will want to give these IDs for the control logic that will be implemented -->
                <button type="submit" class="button" style="background:rgb(67, 101, 165);" onclick="alertBox('You have changed your subscription to prime!\n\nYou can now post up to five (5) jobs.\n\nYou will be charged $50 per month. Feel free to cancel anytime.')">
                    PRIME
                </button>
                <button type="submit" class="button" style="background:rgb(216, 188, 32);" onclick="alertBox('You have changed your subscription to gold!\n\nYou can now post an unlimited number of jobs.\n\nYou will be charged $100 per month. Feel free to cancel anytime.')">
                    GOLD
                </button>
            </div>

            <!-- For employers to create job postings -->
            <div class="post-jobs">
                <label><u>Post Job</u></label><br><br>

                <div class="post-jobs-subgrid">
        
                    <form>
                        <label><strong>Job ID</strong></label><br>
                        <input type="text" id="job-id" name ="job-id">
                    </form>
                    <form>
                        <label>Employer ID</label><br>
                        <input type="text" id="employer-id" name ="employer-id">
                    </form>
                    <form>
                        <label>Job Title</label><br>
                        <input type="text" id="job-title" name ="job-title">
                    </form>
                    <form>
                        <label>Job Category</label><br>
                        <input type="text" id="job-category" name ="job-category">
                    </form>
                    <form>
                        <label>Date Posted</label><br>
                        <input type="date" id="date-posted" name ="date-posted">
                    </form>
                    <form>
                        <label>Salary</label><br>
                        <input type="text" id="salary" name ="salary">
                    </form>
                    <form>
                        <label>Start Date</label><br>
                        <input type="date" id="start-date" name ="start-date">
                    </form>

                    <div>
                        <!-- Empty div  -->
                    </div>

                    <form id="job-description-container">
                        <label>Job Description</label><br>
                        <textarea name="job-description" id="job-descrption" cols="30" rows="10"></textarea>
                    </form>
                    <br>
    
                    <button type="submit" class="button">Post Job</button><br>
                </div>
            </div>

            <!-- A summary of the current (most recent) application for any given job -->
            <div class="application-summary">
                <label><u>Current Application Summary</u></label><br><br>
                <textarea name="application-summary" id="application-summary" cols="34" rows="31"></textarea>
            </div>

        </div>
    </div>

    <br><br><br> 

    <!-- Second (2nd) Employer Container/Dashboard -->
    <div class="dashboard-container">
        <div class="dashboard-employer">

            <div class="help-and-contact">

            <label><u>Help and Contact</u></label><br><br>

                <div class="help-wrapper">
        
                    <small>The 'User Maintenance' section only allows you to change the user type, as this is a form of administrative permissions control.</small>

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

            <div class="update-jobs">
                <label><u>Update Job</u></label><br><br>

                <div class="update-jobs-subgrid">
                
                    <form>
                        <label><strong>Job ID</strong></label><br>
                        <input type="text" id="job-id" name ="job-id">
                    </form>
                    <form>
                        <label>Employer ID</label><br>
                        <input type="text" id="employer-id" name ="employer-id">
                    </form>
                    <form>
                        <label>Job Title</label><br>
                        <input type="text" id="job-title" name ="job-title">
                    </form>
                    <form>
                        <label>Job Category</label><br>
                        <input type="text" id="job-category" name ="job-category">
                    </form>
                    <form>
                        <label>Date Posted</label><br>
                        <input type="date" id="date-posted" name ="date-posted">
                    </form>
                    <form>
                        <label>Salary</label><br>
                        <input type="text" id="salary" name ="salary">
                    </form>
                    <form>
                        <label>Start Date</label><br>
                        <input type="date" id="start-date" name ="start-date">
                    </form>

                    <div>
                        <!-- Empty div  -->
                    </div>

                    <form id="job-description-container">
                        <label>Job Description</label><br>
                        <textarea name="job-description" id="job-description" cols="30" rows="10"></textarea>
                    </form>
                    <br>

                    <button type="submit" class="button">Update Job</button><br>
                </div>
            </div>

            <!-- So that the employer can maintain/update job applications -->
            <div class="update-applications">
                <label><u>Update Application</u></label><br><br>

                <form>
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name ="job-id">
                </form>
                <form>
                    <label><strong>Username</strong></label><br>
                    <input type="text" id="user-id" name ="user-id">
                </form>
                <form>
                    <label>Application Status</label><br>
                    <input type="text" id="user-id" name ="user-id">
                </form>

                <br>

                <form>
                    <label>Message to Applicant</label><br>
                    <textarea name="message-to-applicant" id="message-to-applicant" cols="34" rows="13"></textarea>
                </form>

                <button type="submit" class="button">Update Application</button><br>
            </div>

        </div>
    </div>

    <br><br><a href="./index.php">Return to Employer Login</a><br><br>
</body>
</html>

<?php
    
?>