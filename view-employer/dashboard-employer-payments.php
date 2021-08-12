<?php 

    session_start();

    // code for adding a payment option to an employer account
    require('../php/add-employer-payment-option.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grid-employer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <title>Employer Payments</title>
</head>
<body>

    <!-- Employer Payments Dashboard -->
    <div class="dashboard-container">
        <h3><?php echo (htmlspecialchars($_SESSION['employer']));?>'s payments</h3><br>

        <div class="dashboard-employer"> 

            <form class="payment-information-panel" method="POST" action="">   
            
                <h4>Enter Payment Information</h4>

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

            <div class="account-status-panel">
            
                <h4>Account Status</h4><br>

                <p>
                    
                </p>
            </div>

            <div class="remove-payment-panel">
                <form method="POST" action="">
                    <h4>Remove Payment</h4><br>
                
                    <label>Payment ID</label>
                    <input type="text" name="cardholder-name">

                    <button type="submit" class="button" name="remove-payment">Remove Payment Option</button>
                </form>
            </div>
            
        </div>
    </div>

    <br><br><a href="./dashboard-employer.php">Return to Employer Dashboard</a><br><br>

</body>
</html>