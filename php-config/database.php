<!-- Control logic for insertions into the database at port 3307 -->

<?php
    $server = 'servername';
    $user = 'username';
    $password = 'password';
    $schema = 'schemaname';
    $port = 3306;

    $conn = mysqli_connect($server, $user, $password, $schema, $port);

    // NOTE: Comment/uncomment this for testing/display purposes

    // if (mysqli_connect_errno()) {
    //     echo 'Connection to database failed, ERROR: ' . mysqli_connect_errno() . ' ';
    // }
    // else {
    //     echo 'Connection to database established.' . ' ';
    // }

?>
