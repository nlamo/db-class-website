<!-- Control logic for insertions into the database at port 3307 -->
<?php
    $server = 'localhost';
    $user = 'username';
    $password = 'password';
    $schema = 'database-name';
    $port = 3306;

    $conn = mysqli_connect($server, $user, $password, $schema, $port);

    // Test to see if the connection is working
    if (mysqli_connect_errno()) {
        echo 'Connection to database failed, ERROR: ' . mysqli_connect_errno() . ' ';
    }
    else {
        echo 'Connection to database established.' . ' ';
    }

?>
