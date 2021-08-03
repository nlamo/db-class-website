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
        <p><u><b>User Dashboard</b></u></p><br>

        <div class="dashboard-user">
         
            <!-- TODO: Allow user to simply get all the jobs (full search) -->
            <!-- TODO: Requests for data, will be output by job-data > textarea -->
            <div class="search-job-by-category">
                <u>Search By Category</u><br><br>
                <small>Please enter the category of the job you're looking for:</small><br><br>

                <form>
                    <label>Job Category</label><br>
                    <input type="job-category" id="job-category" name ="job-category">
                </form>

                <button type="submit" class="button">Search</button><br>
            </div>

            <div class="search-job-by-name">
                <u>Search By Name</u><br><br>
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
                    <label><u>Job Data</u></label><br><br>
                    <textarea name="job-data" id="job-data" cols="48" rows="30"></textarea>
                </form>
            </div>

            <div class="apply-for-job">
                <u>Apply for a Job</u><br><br>

                <!-- NOTE: Username of the active user should be stored in a session variable and
                           should be used for making the application -->
                <form>
                    <label><strong>Job ID</strong></label><br>
                    <input type="text" id="job-id" name ="job-id">
                </form>

                <br>
                
                <form>
                    <label>Application</label><br>
                    <textarea name="application" id="application" cols="28" rows="19" style="margin-top:10px;"></textarea>
                </form>

                <button type="submit" class="button" style="width:260px;">Submit Application</button><br>
            </div>

            <div class="maintain-status">
                <u>Maintain Status</u><br><br>
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
                <u>Withdraw Application</u><br><br>

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

        </div>
    </div>

    <br><br><a href="./index.php">Return to User Login</a><br><br>
</body>
</html>