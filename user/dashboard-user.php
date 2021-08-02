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
    <div class="dashboard-container">
        <p><u><b>User Dashboard</b></u></p><br>

        <div class="dashboard-user">
         
            <!-- TODO: Requets for data, will be output by job-data > textarea -->
            <div class="user-categories">
                <u>Select User Category</u>
            </div>

            <div class="search-job-by-name">
                <u>Search Job By Name</u>
            </div>

            <div class="search-job-by-category">
                <u>Search Job By Category</u>
            </div>

            <!-- TODO: Job data retrieved from MySQL DB will be output here -->
            <div class="job-data">
                <form>
                    <label for="job-data"><u>Job Data</u></label><br><br>
                    <textarea name="job-data" id="job-data" cols="48" rows="30"></textarea>
                </form>
            </div>

            <!-- TODO: Use a subgrid, as with the employer dashboard -->
            <div class="apply-for-job">
                <u>Apply for a Job</u>
            </div>

            <div class="update-profile">
                <u>Update Profile</u>
            </div>

            <div class="withdraw-application">
                <u>Withdraw Application</u>
            </div>

            <div class="delete-profile">
                <u>Delete Profile</u>
            </div>
        </div>
    </div>

    <br><a href="./index.php">Return to User Login</a>
</body>
</html>