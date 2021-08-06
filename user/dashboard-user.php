<?php
    session_start();

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

        <div class="dashboard-user">
         
            <!-- TODO: Allow user to simply get all the jobs (full search) -->
            <!-- TODO: Requests for data, will be output by job-data > textarea -->
            <div class="search-job-by-category">
                <h4>Search By Category</h4><br><br>
                <small>Please enter the category of the job you're looking for:</small><br><br>

                <form>
                    <label>Job Category</label><br>
                    <input type="job-category" id="job-category" name ="job-category">
                </form>

                <button type="submit" class="button">Search</button><br>
            </div>

            <div class="search-job-by-name">
                <h4>Search By Name</h4><br><br>
                <small>Please enter the name of the job you're looking for:</small><br><br>

                <form>
                    <label>Job Name</label><br>
                    <input type="job-name" id="job-name" name ="job-name">
                </form>

                <button type="submit" class="button">Search</button><br>
            </div>

            <!-- TODO: Job data retrieved from MySQL DB will be output here -->
            <div class="job-data">
                <form>
                    <h4>Job Data</h4><br><br>
                    <textarea name="job-data" id="job-data" cols="48" rows="30"></textarea>
                </form>
            </div>

            <div class="apply-for-job">
                <h4>Apply for a Job</h4><br><br>

                <!-- NOTE: Username of the active user should be stored in a session variable and
                           should be used for making the application -->
                <form>
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name ="job-id">
                </form>
                <form>
                    <label><strong>Application No.</strong></label><br>
                    <input type="text" id="application-no" name ="application-no">
                </form>

                <br>

                <form>
                    <label>Application</label><br>
                    <textarea name="application" id="application" cols="28" rows="16" style="margin-top:10px;"></textarea>
                </form>

                <button type="submit" class="button" style="width:260px;">Submit Application</button><br>
            </div>

            <div class="maintain-status">
                <h4>Maintain Status</h4><br><br>
                <small>Set application to active or inactive:</small><br><br>
                
                <form>
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name ="job-id">
                </form>
                <form>
                    <label><strong>Application No.</strong></label><br>
                    <input type="text" id="application-no" name ="application-no">
                </form>
                <form>
                    <label>Status</label><br>
                    <input type="text" id="application-status" name ="application-status">
                </form>

                <button type="submit" class="button">Update Status</button><br>
            </div>

            <div class="withdraw-application">
                <h4>Withdraw Application</h4><br><br>

                <form>
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name ="job-id">
                </form>
                <form>
                    <label><strong>Application No.</strong></label><br>
                    <input type="text" id="application-no" name ="application-no">
                </form>

                <button type="submit" class="button">Withdraw</button><br>
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
            </div>

            <div class="update-user-profile">
                <h4>Update User Profile</h4><br><br>

                <br>
                
                <label>Password</label><br>
                <input type="password" name="password"><br><br>

                <label>First Name</label><br>
                <input type="first-name" name="first-name"><br><br>

                <label>Last Name</label><br>
                <input type="last-name" name="last-name"><br><br>

                <label>E-mail</label><br>
                <input type="email" name="email"><br><br>

                <label>Security Question:</label><br>
                <div class="security-question">What is your favourite film of<br> all time?</div>
     
                <input type="security-answer" name="security-answer"><br><br>


                <button type="submit" class="button" style="width:260px;">Update Profile</button><br>
            </div>

            
            <div class="delete-user-account">

                <h4>Delete User Account</h4><br><br>

                <small>Are you <i>absolutely 100% certain that you really, truly wish to delete your precious user account?</i> </small><br><br>

                <small>If you do choose to walk this dark path - that is, account deletion - then you should know that there is no turning back. This action is completely irrevocable.</small><br><br>
                
                <small>Basically, it will be as if you had never existed. We will miss you, but know that on life's path - during this great journey, where many follies are committed, and much anxiety and anomie subsumed under the assumption of personal validation and identification - there is always the opportunity for recourse, for redemption.</small><br><br>
                
                <small>What we mean to say is, er, that you're always welcome back if you discover your true path.</small><br><br>
                
                <form>
                    <label>Enter 'Yes' to Delete Account</label><br>
                    <input type="text" id="delete-user-account" name ="delete-user-account">
                </form>

                <button type="submit" class="button">Delete Account</button><br>
                
            </div>
        </div>
    </div>

    <br><br><a href="./index.php">Return to User Login</a><br><br>
</body>
</html>