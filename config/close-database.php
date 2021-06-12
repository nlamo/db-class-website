<?php

mysqli_close($conn);

// If it's not a resource, then it's closed
if (!is_resource($conn)) {
    echo 'Database closed.' . ' ';
}
else {
    echo 'Database is still running.' . ' ';
}

?>