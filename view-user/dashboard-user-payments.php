<?php
    session_start();

    // code for adding a payment option to a user account
    require('../php/add-user-payment-option.php');

    // code for editing a payment option for a user account
    require('../php/edit-user-payment-option.php');

    // deleting a user payment option, but only if account is settled
    require('../php/delete-user-payment-option.php');
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
    <title>User Payments</title>
</head>
<body>

    <!-- Employer Payments Dashboard -->
    <div class="dashboard-container">
        <h3><?php echo (htmlspecialchars($_SESSION['user']));?>'s payments</h3><br>

        <div class="dashboard-user">

            <form class="payment-information-panel" method="POST" action="">

                <h4>New Option</h4>

                <div class="card-info-container">
                    <label>Payment Method (Chequing or Credit)</label>
                    <input type="text" name="payment-method">

                    <label>Cardholder Name</label>
                    <input type="text" name="cardholder-name">

                    <label>Card Number</label>
                    <input type="text" name="card-number">

                    <label>Date of Expiration</label>
                    <input type="date" name="expiration-date">

                    <label>Withdrawal Type</label>
                    <input type="text" name="withdrawal-type"><br>

                    <label>Account Balance</label>
                    <input type="text" name="account-balance"><br>
                </div>

                <div class="lone-button">
                    <button type="submit" class="button" id="payment-option-button" name="add-payment-option">Add Payment Option</button>
                </div>

            </form>

            <form class="edit-payment-panel" method="POST" action="">

                <h4>Edit Option</h4>

                <div class="card-info-container">
                    <label><b>Payment Account ID</b></label>
                    <input type="text" name="payment-account-id">

                    <label>Payment Method (Chequing or Credit)</label>
                    <input type="text" name="payment-method">

                    <label>Cardholder Name</label>
                    <input type="text" name="cardholder-name">

                    <label>Card Number</label>
                    <input type="text" name="card-number">

                    <label>Date of Expiration</label>
                    <input type="date" name="expiration-date">

                    <label>Withdrawal Type</label>
                    <input type="text" name="withdrawal-type"><br>

                    <label>Account Balance</label>
                    <input type="text" name="account-balance"><br>
                </div>

                <div class="lone-button">
                    <button type="submit" class="button" id="edit-payment-button" name="edit-payment-option">Edit Payment Option</button>
                </div>
            </form>

            <div class="account-status-panel">

                <h4>Account Status</h4><br>

                <p>
                    <?php if(htmlspecialchars($_SESSION['hasFrozenAccount'])): ?>

                        <?php echo 'Your account is currently frozen, as you have a balance owing on at least one your account balances.<br><br>Most of the application functionality has been removed from your account.<br><br>Until the balance has been resolved, you will receive a warning message once per week.' ?>

                    <?php else: ?>

                        <?php echo 'Your account currently has no outstanding balance.<br><br>You retain full functionality of your user account.<br><br>We hope that your job search is going well!' ?>

                    <?php endif; ?>
                </p>
            </div>

            <div class="remove-payment-panel">
                <form method="POST" action="">
                    <h4>Remove Payment</h4><br>

                    <label>Payment Account ID</label>
                    <input type="text" name="payment-account-id">

                    <button type="submit" class="button" name="remove-payment-option">Remove Payment Option</button>
                </form>
            </div>

        </div>
    </div>

    <br><br><a href="./dashboard-user.php">Return to User Dashboard</a><br><br>

</body>
</html>
