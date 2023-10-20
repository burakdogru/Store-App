<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    
    $con = mysqli_connect($host, $username, $password);
    if ($con === false) {
        die("Could not connect. " . mysqli_connect_error());
    }
    echo "Connect Successfully."."<br>";
    $query = "CREATE DATABASE IF NOT EXISTS store";
    if (mysqli_query($con, $query)) {
        echo "Database created successfully";
    } else {
        echo "Could not able to execute $query. " . mysqli_error($con);
    }
    mysqli_close($con);
    header("location: create_tables.php");
    exit();
?>