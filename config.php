<?php
    $host = "localhost";
    $username = "root";
    $password = "";  
    $db_name = "store";

    $con = mysqli_connect($host, $username, $password, $db_name);
    if($con === false){
        die("Could not connect. " . mysqli_connect_error());
    }
?>