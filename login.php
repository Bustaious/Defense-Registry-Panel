<?php

// Replace these credentials with your actual MySQL database credentials
$hostname = 'localhost';
$username = 'firstuser';
$password = 'buzter325';
$database = 'securdat';

// Create a connection to the MySQL database
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize the input (for basic security, to prevent SQL injection)
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Query the database using prepared statements to check if the user exists and the password is correct
    $query = "SELECT password FROM admin_info WHERE username=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword);
    mysqli_stmt_fetch($stmt);

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
  
        echo "Login successful!";
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>

