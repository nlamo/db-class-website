<!-- Using POST/REDIRECT/GET pattern to prevent form resubmission requests -->

<?php

    // IMPORTANT: This is not a complete deletion, and it maintains the ID.
    // IMPORTANT: It is not permitted to delete a frozen account with balance owing.

    if (isset($_POST['remove-payment-option'])) {

        require('../php-config/database.php');

        $user = mysqli_real_escape_string($conn, $_SESSION['user']);
        $accountID = mysqli_real_escape_string($conn, $_POST['payment-account-id']);

        if (!empty($accountID)) 
        {

            if (!($_SESSION['hasFrozenAccount'])) 
            {
                $sqlQuery = "UPDATE payment_account SET payment_account.username=NULL, payment_account.cardholder_name=NULL, payment_account.card_number=NULL, payment_account.expiration_date=DEFAULT, payment_account.payment_method=NULL, payment_account.withdrawal_type=NULL, payment_account.balance=NULL, payment_account.status=NULL WHERE payment_account.payment_account_ID='$accountID' AND payment_account.username='$user'";

                mysqli_query($conn, $sqlQuery);
                require('../php-config/close-database.php');
                header('Location: dashboard-user-payments.php');
                exit();
            }
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-user-payments.php');
        exit();
    }
?>