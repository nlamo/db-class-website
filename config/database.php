<!-- Control logic for insertions into the remote database -->

<!-- Add the correct inputs for the connection -->
<!-- Such information was provided to each group member, of course -->

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
