<?php

    if (isset($_POST['make-payment'])) {

        require('../php-config/database.php');


        $employer = mysqli_real_escape_string($conn, $_SESSION['employer']);
        $paymentAccountID = mysqli_real_escape_string($conn, $_POST['payment-account-id']);
        $userCategory = mysqli_real_escape_string($conn, $_POST['user-category']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);

        // Checking if the account and the employer session match
        $isAccountOfEmployerQuery = "SELECT COUNT(*) AS returnValue FROM payment_account WHERE payment_account.payment_account_ID='$paymentAccountID' AND payment_account.username='$employer'";

        $isAccountOfEmployerResult = mysqli_query($conn, $isAccountOfEmployerQuery);
        $isAccountOfEmployerRow = $isAccountOfEmployerResult->fetch_assoc();
        $isAccountOfEmployer = $isAccountOfEmployerRow['returnValue'];


        // Check if the account belongs to the active user
        if ($isAccountOfEmployer)
        {
            
            $accountHasSufficientFundsQuery = "SELECT COUNT(*) AS returnValue FROM payment_account WHERE payment_account.payment_account_ID='$paymentAccountID' AND $total <= payment_account.balance";

            $accountHasSufficientFundsResult = mysqli_query($conn, $accountHasSufficientFundsQuery);
            $accountHasSufficientFundsRow = $accountHasSufficientFundsResult->fetch_assoc();
            $accountHasSufficientFunds = $accountHasSufficientFundsRow['returnValue'];

            
            // Check if the account has sufficient funds
            if ($accountHasSufficientFunds)
            {
                $employerPaymentQuery = "INSERT INTO payment VALUES (DEFAULT, '$paymentAccountID', '$userCategory', '$total')";

                if (mysqli_query($conn, $employerPaymentQuery))
                {
                    $_SESSION['querySuccessful'] = true;
                }
                else
                {
                    $_SESSION['querySuccessful'] = false;
                }
    
                require('../php-config/close-database.php');
                header('Location: ./employer-payment.php');
                exit();
            }
            else 
            {
                $_SESSION['accountHasSufficientFunds'] = false;
                require('../php-config/close-database.php');
                header('Location: ./employer-payment.php');
                exit();
            }
       
        }
        else 
        {
            $_SESSION['querySuccessful'] = false;
        }
        

        require('../php-config/close-database.php');
        header('Location: ./employer-payment.php');
        exit();
    }
?>