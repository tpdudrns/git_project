<?php
    $servername = "192.168.56.1";
    $username = "sydb";
    $password = "cj642djk82t3qj9t3aydyre8gwjqma585yfd9kef"; 
    $dbname = "myDB"; 

    $connect = mysqli_connect($servername, $username, $password, $dbname) or die ("db_connection_error")
?>