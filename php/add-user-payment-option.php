<?php

    if ( isset($_POST['add-payment-option']) ) {

        require('../php-config/database.php');


        if ( isset($_POST['payment-method']) && isset($_POST['cardholder-name']) && isset($_POST['card-number']) && isset($_POST['withdrawal-type']) ) {

            $user = mysqli_real_escape_string($conn, $_SESSION['user']);
            $cardholderName = mysqli_real_escape_string($conn, $_POST['cardholder-name']);
            $cardNumber = mysqli_real_escape_string($conn, $_POST['card-number']);
            $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment-method']);
            $withdrawalType = mysqli_real_escape_string($conn, $_POST['withdrawal-type']);

            // convert date to timestamp
            $expirationDateTimestamp = strtotime($_POST['expiration-date']);

            // convert date to MySQL-complaint format
            $expirationDateYMD = date("Y-m-d H:i:s", $expirationDateTimestamp);

            $expirationDate = mysqli_real_escape_string($conn, $expirationDateYMD);

            $sqlQuery = "INSERT INTO payment_information(payment_information_ID, username, cardholder_name, card_number, expiration_date, payment_method, withdrawal_type) VALUES (DEFAULT, '$user', '$cardholderName', '$cardNumber', '$expirationDate', '$paymentMethod', '$withdrawalType')";

            mysqli_query($conn, $sqlQuery);

            require('../php-config/close-database.php');
            header('Location: dashboard-user-payments.php');
            exit();
        }

        require('../php-config/close-database.php');
        header('Location: dashboard-user-payments.php');
        exit();
    }

?>