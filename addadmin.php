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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Sanitize the input (for basic security, to prevent SQL injection)
    $username = mysqli_real_escape_string($connection, $username);

    // Check if the username already exists
    $query = "SELECT * FROM admin_info WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert the new admin account into the database
        $sql = "INSERT INTO admin_info (username, password) VALUES ('$username', '$hashedPassword')";

        if (mysqli_query($connection, $sql)) {
            // Success message
            $response = "Admin account created successfully.";
        } else {
            // Error message
            $response = "Error creating admin account.";
        }
        
    }

    // Close the database connection
    mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <!-- Add your HTML content here -->

    <!-- Custom popup/modal -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeResponseModal()">&times;</span>
            <p><?php echo $response; ?></p>
        </div>
    </div>

    <?php if (!empty($response)) { ?>
        <!-- Trigger the popup -->
        <button onclick="showResponseModal()">Show Popup</button>
    <?php } ?>

    <script>
        // Function to show the custom popup/modal
        function showResponseModal() {
            const responseModal = document.getElementById("responseModal");
            responseModal.style.display = "block";
        }

        // Function to close the custom popup/modal
        function closeResponseModal() {
            const responseModal = document.getElementById("responseModal");
            responseModal.style.display = "none";
        }
    </script>