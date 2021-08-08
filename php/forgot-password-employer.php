<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<!-- NOTE: Forgot password only for admin/employer -->
<?php 

    if (isset($_POST['get-password'])) {

        require('../php-config/database.php');

        if (isset($_POST['employer']) && isset($_POST['security-answer'])) 
        {
            
            $employer = mysqli_real_escape_string($conn, $_POST['employer']);
            $securityAnswerInput = htmlspecialchars($_POST['security-answer']);
    
            $correctSecurityAnswerQuery = "SELECT user.security_answer AS securityAnswer FROM user WHERE user.username='$employer'";

            $passwordQuery = "SELECT user.password AS employerPassword FROM user WHERE user.username='$employer'";
    
            $isAdminOrEmployerQuery = "SELECT COUNT(*) AS returnValue FROM user WHERE user.username='$employer' AND (user.user_category = 'Admin' OR user.user_category LIKE 'Employer%') ";

            // Running the queries to get the counts
            $correctSecurityAnswer = mysqli_query($conn, $correctSecurityAnswerQuery);
            $password = mysqli_query($conn, $passwordQuery);
            $isAdminOrEmployer = mysqli_query($conn, $isAdminOrEmployerQuery);
    
            // Doing this thing...
            $correctSecurityAnswerRow = $correctSecurityAnswer->fetch_assoc();
            $passwordRow = $password->fetch_assoc();
            $isAdminOrEmployerRow = $isAdminOrEmployer->fetch_assoc();
    
            // Getting the results... 
            $correctSecurityAnswerResult = $correctSecurityAnswerRow['securityAnswer'];
            $passwordResult = $passwordRow['employerPassword'];
            $isAdminOrEmployerResult = $isAdminOrEmployerRow['returnValue'];
    
            // if it's right, redirect to the same page with password
            // else if it's wrong, redirect without password
            if ( (strcmp($securityAnswerInput, $correctSecurityAnswerResult) === 0) && $isAdminOrEmployerResult) {
                $_SESSION['passwordResult'] = $passwordResult;
                require('../php-config/close-database.php');
                header("Location: employer-password-retrieval.php");
                exit();
            }
            else {
                require('../php-config/close-database.php');
                header("Location: employer-password-retrieval.php");
                exit();
            }
        }
 
        require('../php-config/close-database.php');
        header("Location: employer-password-retrieval.php");
    }
?>