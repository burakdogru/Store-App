<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "store";

    $con = mysqli_connect($host, $username, $password, $db_name);
    if ($con === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $sql = "CREATE TABLE IF NOT EXISTS inventory(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        item_name VARCHAR(30) NOT NULL,
        category_name VARCHAR(30) NOT NULL,
        amount INT(20) NOT NULL,
        price FLOAT NOT NULL,
        isNew INT(10) NOT NULL
    
    )";

    $sql1 = "CREATE TABLE IF NOT EXISTS users(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(70) NOT NULL UNIQUE
    )";
    $sql2 = "CREATE TABLE IF NOT EXISTS category(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL
    )";
    
    if(mysqli_query($con, $sql)){
        echo "Table created successfully.<br>";
       } else{
        echo "Could not crate" . mysqli_error($con);
    } 
    if(mysqli_query($con, $sql1)){
        echo "Table created successfully.<br>";
       } else{
        echo "Could not crate" . mysqli_error($con);
    } 

    if(mysqli_query($con, $sql2)){
        echo "Table created successfully.";
       } else{
        echo "Could not crate" . mysqli_error($con);
    } 

    mysqli_close($con);
    header("location: ../home.php");
    exit();
?>