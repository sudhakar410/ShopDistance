<?php
// Database configuration
$servername = "localhost"; // Change to your MySQL server's hostname or IP address
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$database = "datasense"; // Change to the name of your MySQL database

// Create a connection to the MySQL database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Connection is successful
//echo "Connected to MySQL successfully";

// You can now use the $conn variable to perform database operations (e.g., queries, inserts, updates, deletes).
?>






