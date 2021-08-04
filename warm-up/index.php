
<?php
    require('../php-config/database.php');

    if (isset($_POST['submit-publisher'])) {
        
        $publisher_id = mysqli_real_escape_string($conn, $_POST['publisher-id']);
        $company_name = mysqli_real_escape_string($conn, $_POST['company-name']);
        $branch = mysqli_real_escape_string($conn, $_POST['branch']);
        $telephone_number = mysqli_real_escape_string($conn, $_POST['telephone-number']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $province = mysqli_real_escape_string($conn, $_POST['province']);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal-code']);
        $email_address = mysqli_real_escape_string($conn, $_POST['email-address']);
        $website = mysqli_real_escape_string($conn, $_POST['website']);

        $sql_query = "INSERT INTO publisher(publisher_id, company_name, branch, telephone_number, address, city, province, postal_code, email, website) VALUES('$publisher_id', '$company_name', '$branch', '$telephone_number', '$address', '$city', '$province', '$postal_code', '$email_address', '$website')";


        // mysqli_query executes the query AND
        // if it's successful, it returns true; if it's not, it returns false
       
        if (mysqli_query($conn, $sql_query)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
        else {
            echo 'Query submission error: ' . mysqli_error($conn) . ' ';
        }
    }

    require('../config/close-database.php');
?>

<br>
<p>----------------------------------------------------------------------------------------</p>
<br>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warm-Up Forms</title>
</head>
<body>

    <!-- All entries are VARCHAR **except** where noted -->
    <form method="POST" action="">

        <!-- INT -->
        <label><u>Publisher ID</u></label><br><br>
        <input type="text" name="publisher-id"></textarea>

        <br><br>

        <label><u>Company Name</u></label><br><br>
        <input type="text" name="company-name"></textarea>

        <br><br>

        <!-- INT -->
        <label><u>Branch</u></label><br><br>
        <input type="text" name="branch"></textarea>

        <br><br>

        <label><u>Telephone Number</u></label><br><br>
        <input type="text" type="text" name="telephone-number"></textarea>

        <br><br>

        <label><u>Address</u></label><br><br>
        <input type="text" name="address"></textarea>
        
        <br><br>

        <label><u>City</u></label><br><br>
        <input type="text" name="city"></textarea>

        <br><br>

        <!--  2 char max -->
        <label><u>Province</u></label><br><br>
        <input type="text" name="province"></textarea>

        <br><br>

        <!--  7 char max -->
        <label><u>Postal Code</u></label><br><br>
        <input type="text" name="postal-code"></textarea>

        <br><br>

        <label><u>Email Address</u></label><br><br>
        <input type="text" name="email-address"></textarea>

        <br><br>

        <label><u>Website</u></label><br><br>
        <input type="text" name="website"></textarea>

        <br><br>
        
        <input type="submit" name="submit-publisher" class="button"><br>
    </form>
</body>
</html>