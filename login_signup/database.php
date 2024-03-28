<?php
// Database connection parameters
$host = 'localhost'; // or your host (could be an IP address or domain name)
$dbname = 'LoanMe'; // your database name
$username = 'root'; // your database username
$password = 'HelloWorld'; // your database password

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optionally, you can set the connection to use UTF-8 encoding which is recommended
mysqli_set_charset($conn, "utf8");

// At this point, $conn is ready to use for making queries to the database
?>
