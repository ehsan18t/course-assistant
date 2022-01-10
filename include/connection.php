<?php
// Connect to MySQL
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // If database is exists select it
    if (!mysqli_select_db($conn, DB_NAME)){
        // id not exists create one
//        $sql = "CREATE DATABASE ".DB_NAME;
//        if ($conn->query($sql) === TRUE) {
//            echo "Database created successfully";
//        } else {
//            echo "Error creating database: " . $conn->error;
//        }
        die("Connection failed: " . $conn->connect_error);
    }
