<?php

    session_start();

     // user payment logic
     require('../php/make-payment-user.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grid-user.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <title>User Make Payment</title>
</head>
<body>

    <!-- NOTE: for printing a message if a query has succeeded/failed -->
    <?php if (isset($_SESSION['querySuccessful'])): ?> 
    
    <?php if ($_SESSION['querySuccessful'] == true): ?>
        
        <?php 
            echo '<script>setTimeout(function() { alert("Query successful!"); }, 400)</script>';
            unset($_SESSION['querySuccessful']);
        ?>
    
    <?php else: ?>
        
        <?php 
            echo '<script>setTimeout(function() { alert("Query failed."); }, 400)</script>';
            unset($_SESSION['querySuccessful']);
        ?>

    <?php endif; ?>

<?php endif; ?>

  <!-- NOTE: for printing if the account has insufficient funds -->
    <?php if (isset($_SESSION['accountHasSufficientFunds'])): ?> 

        <?php if ($_SESSION['accountHasSufficientFunds'] == false): ?>

            <?php 
                echo '<script>setTimeout(function() { alert("Your account has insufficient funds to process the payment."); }, 400)</script>';
                unset($_SESSION['accountHasSufficientFunds']);
            ?>

        <?php endif; ?>
    <?php endif; ?>


    <div class="dashboard-container" style="width: 500px;">
        <h3><?php echo (htmlspecialchars($_SESSION['user']));?>'s payments</h3><br>

        <div class="payment-dashboard">

            <form method="POST" action="" class="user-make-payment">
                <h4>Make a Payment</h4><br><br><br><br>

                <label>Payment Account ID</label>
                <input type="text" name="payment-account-id">

                <label>User Category</label>
                <input type="text" name="user-category">

                <label>Payment Total</label>
                <input type="text" name="total">

                <br><br><br><br><br><br>

                <div class="lone-button">
                    <button type="submit" class="button" id="payment-option-button" name="make-payment">Make Payment</button>
                </div>
            </form>
        </div>

    </div>

    <br><br><a href="./dashboard-user-payments.php">Return to User Payments</a><br><br>
</body>
</html>