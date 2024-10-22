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

// Initialize variables to hold form data and response messages
$username = '';
$password = '';
$response = array();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize the input (for basic security, to prevent SQL injection)
    $username = mysqli_real_escape_string($connection, $username);

    // Check if the user exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Reset login attempts upon successful login
            $stmt_reset = $connection->prepare("UPDATE users SET login_attempts = 0, last_failed_login = NULL WHERE username = ?");
            $stmt_reset->bind_param("s", $username);
            $stmt_reset->execute();
            $stmt_reset->close();
            
            $response['success'] = true;
            $response['message'] = 'Login successful!';

            // Store necessary user information in the session
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['major'] = $row['major'];
            $_SESSION['email'] = $row['email'];

            
        } else {
            // Increment login attempts and update last failed login timestamp
            $stmt_update = $connection->prepare("UPDATE users SET login_attempts = login_attempts + 1, last_failed_login = CURRENT_TIMESTAMP WHERE username = ?");
            $stmt_update->bind_param("s", $username);
            $stmt_update->execute();
            $stmt_update->close();
            
            $response['success'] = false;
            $response['message'] = 'Invalid username or password.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid username. Please try again.';
    }

    // Convert the response array to JSON
    $json_response = json_encode($response);

    // Output the JSON response
    echo $json_response;
}

// Close the database connection
mysqli_close($connection);
?>
