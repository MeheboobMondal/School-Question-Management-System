<?php
// $host = 'localhost'; // MySQL server hostname
// $username = 'root'; // MySQL username
// $password = ''; // MySQL password
// $database = 'mcms'; // Database name

$DBCON = mysqli_connect('localhost', 'root', '', 'mcms');

// Check if the connection was successful
if (!$DBCON) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully!";
?>