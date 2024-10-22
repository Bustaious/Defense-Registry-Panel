

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
$username = 'username';
$password = 'password';
$email = 'email';
$response = 'popupContainer';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username, password, and email from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Sanitize the input (for basic security, to prevent SQL injection)
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "<script>alert('Username already exists. Please choose a different username.'); window.location.href = 'users.html';</script>";
    } else {
        // Insert the new user account into the database
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        
        $response = array();

if (mysqli_query($connection, $sql)) {
    // Success message
    echo "<script>alert('Register successful!'); window.location.href = 'users.html';</script>";
} else {
    // Error message
    echo "<script>alert('Error! Something went wrong.'); window.location.href = 'users.html';</script>";
}

// Convert the response array to JSON
$json_response = json_encode($response);

// Output the JSON response
echo $json_response;
}
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <!-- Add your HTML content here -->
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <input type="submit" value="Register">
    </form>

    
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
</body>
</html>