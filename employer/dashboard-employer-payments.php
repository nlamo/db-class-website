<?php 

    session_start()

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
            
            <div class="payment-type-panel">

                <h4>Choose Payment Type</h4>

                <button class="button">
                     Chequing 
                </button>

                <button class="button">
                    Credit 
                </button>
            </div>

            <div class="payment-information-panel">

                <h4>Enter Payment Information</h4><br>

                <label>Cardholder Name</label><br>
                <input type="text" name="cardholder-name">
              
                <label>Card Number</label><br>
                <input type="text" name="card-number">

                <label>Date of Expiration</label><br>
                <input type="date" name="expiration-date">
        
                <label>Withdrawal Type</label><br>
                <input type="text" name="withdrawal-type"><br><br>
       
                <button class="button" name="add-payment-type">Add Payment Type</button>
            </div>

            <div class="account-status-panel">
            
                <h4>Account Status</h4><br>

                <p>
                    
                </p>
            </div>

            <div class="remove-payment-panel">
                
                <h4>Remove Payment</h4><br><br>
            
                <label>Payment ID</label>
                <input type="text" name="cardholder-name">

                <button class="button" name="remove-payment">Remove Payment</button>
            </div>
        </div>
    </div>

    <br><br><a href="./dashboard-employer.php">Return to Employer Dashboard</a><br><br>

</body>
</html>