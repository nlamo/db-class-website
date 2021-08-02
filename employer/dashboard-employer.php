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
    <div class="dashboard-container">
        <p><u><b>Employer Dashboard</b></u></p><br>

        <!-- TODO: Add a contact page -->
        <a href="#">
            <button class="contact-button">
                Need Help? Contact Us.
            </button>
        </a> 

        <!-- TODO: Add a class in the grid for "maintaining" jobs -->
        <div class="dashboard-employer">
            
            <!-- For adminstrators to update the properties of given users -->
            <div class="maintain-users">
                <label for=""><u>User Maintenance</u></label><br><br>

                <form>
                    <label for="user-id"><strong>User ID</strong></label><br>
                    <input type="text" id="user-id" name ="user-id">
                </form>
                <form>
                    <label for="first-name">First Name</label><br>
                    <input type="text" id="first-name" name ="first-name">
                </form>
                <form>
                    <label for="last-name">Last Name</label><br>
                    <input type="text" id="last-name" name ="last-name">
                </form>

                <button type="submit" class="button" value="Update";>
                    Submit
                </button>
            </div>

            <!-- For adminstrators to upgrade or downgrade their category -->
            <!-- NOTE: Overriding the colours on the button classes used here -->
            <div class="employer-categories">
                <label for=""><u>Employer Categories</u></label><br><br>

                <small>Need more functionality? Upgrade!</small> 

                <!-- TODO: Probably will want to give these IDs for the control logic that will be implemented -->
                <button type="submit" class="button"style="background:rgb(67, 101, 165);" onclick="alertBox('You have changed your subscription to prime!\n\nYou can now post up to five (5) jobs.\n\nYou will be charged $50 per month. Feel free to cancel anytime.')">
                    PRIME
                </button>
                <button type="submit" class="button" style="background:rgb(216, 188, 32);" onclick="alertBox('You have changed your subscription to gold!\n\nYou can now post an unlimited number of jobs.\n\nYou will be charged $100 per month. Feel free to cancel anytime.')">
                    GOLD
                </button>
            </div>

            <!-- For employers to create job postings -->
            <div class="post-jobs">
                <label for=""><u>Post Job</u></label><br><br>

                <div class="post-jobs-subgrid">
        
                    <form>
                        <label for="job-id"><strong>Job ID</strong></label><br>
                        <input type="text" id="job-id" name ="job-id">
                    </form>
                    <form>
                        <label for="employer-id">Employer ID</label><br>
                        <input type="text" id="employer-id" name ="employer-id">
                    </form>
                    <form>
                        <label for="job-title">Job Title</label><br>
                        <input type="text" id="job-title" name ="job-title">
                    </form>
                    <form>
                        <label for="job-category">Job Category</label><br>
                        <input type="text" id="job-category" name ="job-category">
                    </form>
                    <form>
                        <label for="date-posted">Date Posted</label><br>
                        <input type="date" id="date-posted" name ="date-posted">
                    </form>
                    <form>
                        <label for="salary">Salary</label><br>
                        <input type="text" id="salary" name ="salary">
                    </form>
                    <form>
                        <label for="start-date">Start Date</label><br>
                        <input type="date" id="start-date" name ="start-date">
                    </form>

                    <div>
                        <!-- Empty div  -->
                    </div>

                    <form id="job-description-container">
                        <label for="job-description">Job Description</label><br>
                        <textarea name="job-description" id="job-descrption" cols="30" rows="10"></textarea>
                    </form>
                    <br>
    
                    <button type="submit" class="button">Submit</button><br>
                </div>
            </div>

            <!-- A summary of the current (most recent) application for any given job -->
            <div class="application-summary">
                <label for=""><u>Current Application Summary</u></label><br><br>
                <textarea name="application-summary" id="application-summary" cols="40" rows="31"></textarea>
            </div>

        </div>
    </div>

    <br><a href="./index.php">Return to Employer Login</a>
</body>
</html>

<?php
    
?>