<?php
// Replace the database credentials with your actual database details
$hostname = 'localhost';
$username = 'firstuser';
$password = 'buzter325';
$database = 'securdat';

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>