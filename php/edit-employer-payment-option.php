<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php
    

    if (isset($_POST['edit-payment-option'])) {

        require('../php-config/database.php');
 
        $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);
        $accountID = mysqli_real_escape_string($conn, $_POST['payment-account-id']);
        $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment-method']);
        $cardholderName = mysqli_real_escape_string($conn, $_POST['cardholder-name']);
        $cardNumber = mysqli_real_escape_string($conn, $_POST['card-number']);
        $withdrawalType = mysqli_real_escape_string($conn, $_POST['withdrawal-type']);
        $accountBalance = mysqli_real_escape_string($conn, $_POST['account-balance']);
        $accountStatus = '';

        // convert date to timestamp
        $expirationDateTimestamp = strtotime($_POST['expiration-date']);

        // convert date to MySQL-compliant format
        $expirationDateYMD = date("Y-m-d H:i:s", $expirationDateTimestamp);

        $expirationDate = mysqli_real_escape_string($conn, $expirationDateYMD);

        // NOTE: This 'logic' is fine for the time being, but realistically, there is an issue. If one of the queries returns false, and sets the SESSION variable, it can still by overriden by a successful query to follow. Since there's only one alert() that is triggered, this could produce a 'false positive' of sorts. Nevertheless, all of the queries are working.

        if (!empty($accountID) || !empty($paymentMethod) || !empty($cardholderName) || !empty($cardNumber) || !empty($withdrawalType) || !empty($accountBalance) )
        {
            
            if (!empty($accountID) && !empty($paymentMethod)) {
                $sqlQuery = "UPDATE payment_account SET payment_account.payment_method='$paymentMethod' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                
                if (mysqli_query($conn, $sqlQuery)) {
                    $_SESSION['querySuccessful'] = true;
                }
                else {
                    $_SESSION['querySuccessful'] = false;
                }
            }
    
            if (!empty($accountID) && !empty($cardholderName)) {
                $sqlQuery = "UPDATE payment_account SET payment_account.cardholder_name='$cardholderName' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                
                if (mysqli_query($conn, $sqlQuery)) {
                    $_SESSION['querySuccessful'] = true;
                }
                else {
                    $_SESSION['querySuccessful'] = false;
                }
            }
    
            if (!empty($accountID) && !empty($cardNumber)) {
                $sqlQuery = "UPDATE payment_account SET payment_account.card_number='$cardNumber' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                
                if (mysqli_query($conn, $sqlQuery)) {
                    $_SESSION['querySuccessful'] = true;
                }
                else {
                    $_SESSION['querySuccessful'] = false;
                }
            }
    
            if (!empty($accountID) && !empty($expirationDate)) {
                $sqlQuery = "UPDATE payment_account SET payment_account.expiration_date='$expirationDate' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                
                if (mysqli_query($conn, $sqlQuery)) {
                    $_SESSION['querySuccessful'] = true;
                }
                else {
                    $_SESSION['querySuccessful'] = false;
                }
            }
    
            if (!empty($accountID) && !empty($withdrawalType)) {
                $sqlQuery = "UPDATE payment_account SET payment_account.withdrawal_type='$withdrawalType' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                
                if (mysqli_query($conn, $sqlQuery)) {
                    $_SESSION['querySuccessful'] = true;
                }
                else {
                    $_SESSION['querySuccessful'] = false;
                }
            }
    
            if (!empty($accountID) && !empty($accountBalance)) {
    
                // setting value of account status based on balance
                if ($accountBalance < 0) {
                    $accountStatus = 'Frozen';
                }
                else {
                    $accountStatus = 'Settled';
                }
    
                $sqlQuery = "UPDATE payment_account SET payment_account.balance='$accountBalance' WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$employer'";
                mysqli_query($conn, $sqlQuery);
            }
        }
        else 
        {
            $_SESSION['querySuccessful'] = false;
        }
      
        require('../php-config/close-database.php');
        header('Location: dashboard-employer-payments.php');
        exit();
    }
?>