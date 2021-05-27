<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grid-employer.css">
    <title>Employer Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <p><u>Employer Dashboard</u></p><br>

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

                <input type="submit" class="button" value="Update";>
            </div>

            <!-- For adminstrators to upgrade or downgrade their category -->
            <!-- NOTE: Overriding the colours on the button classes used here -->
            <div class="employer-categories">
                <label for=""><u>Employer Categories</u></label><br><br>

                <input type="submit"class="button" value="PRIME" style="background:rgb(67, 101, 165)";>
                <input type="submit" class="button" value="GOLD" style="background:rgb(216, 188, 32);">
                <!-- TODO: Add 'Prime' and 'Gold' -->
            </div>

            <!-- For administrators to create job postings -->
            <div class="post-jobs">
                <div class="post-jobs-subgrid">
                    <label for=""><u>Post Job</u></label><br><br>

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
                        <label for="job-category-id">Job Category ID</label><br>
                        <input type="text" id="job-category-id" name ="job-category-id">
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
                    <form>
                        <label for="employees-needed">No. of Employees Needed</label><br>
                        <input type="text" id="employees-needed" name ="employees-needed">
                    </form>
                    <form>
                        <label for="job-description">Job Description</label><br>
                        <textarea name="job-description" id="job-descrption" cols="30" rows="10"></textarea>
                    </form>
                    <br>
    
                    <!-- NOTE: Really shouldn't do this, but I adjusted the style of this button to override the .button defaults in styles.css -->
                    <input type="submit" class="button" style="width:200%; margin-top: 80px;"><br>
                </div>
            </div>

            <!-- A summary of the current (most recent) application for any given job -->
            <div class="application-summary">
                <label for=""><u>Current Application Summary</u></label><br><br>
                <textarea name="application-summary" id="application-summary" cols="45" rows="35"></textarea>
            </div>

        </div>
    </div>

    <br><a href="./index.php">Return to Admin Login</a>
</body>
</html>

<?php
    
?>