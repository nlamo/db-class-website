<?php

    if ( isset($_POST['add-payment-option']) ) {

        require('../php-config/database.php');


        if ( isset($_POST['payment-method']) && isset($_POST['cardholder-name']) && isset($_POST['card-number']) && isset($_POST['withdrawal-type']) && isset($_POST['account-balance'])) {

            $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);
            $cardholderName = mysqli_real_escape_string($conn, $_POST['cardholder-name']);
            $cardNumber = mysqli_real_escape_string($conn, $_POST['card-number']);
            $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment-method']);
            $withdrawalType = mysqli_real_escape_string($conn, $_POST['withdrawal-type']);
            $accountBalance = mysqli_real_escape_string($conn, $_POST['account-balance']);
            $accountStatus = '';

            // convert date to timestamp
            $expirationDateTimestamp = strtotime($_POST['expiration-date']);

            // convert date to MySQL-compliant format
            $expirationDateYMD = date("Y-m-d H:i:s", $expirationDateTimestamp);

            $expirationDate = mysqli_real_escape_string($conn, $expirationDateYMD);

            // setting value of account status based on balance
            if ($accountBalance < 0) 
            {
                $accountStatus = 'Frozen';
            }
            else 
            {
                $accountStatus = 'Settled';
            }

            $sqlQuery = "INSERT INTO payment_account(payment_account_ID, username, cardholder_name, card_number, expiration_date, payment_method, withdrawal_type, balance, status) VALUES (DEFAULT, '$employer', '$cardholderName', '$cardNumber', '$expirationDate', '$paymentMethod', '$withdrawalType', '$accountBalance', '$accountStatus')";

            mysqli_query($conn, $sqlQuery);

            require('../php-config/close-database.php');
            header('Location: dashboard-employer-payments.php');
            exit();
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-employer-payments.php');
        exit();
    }

?>