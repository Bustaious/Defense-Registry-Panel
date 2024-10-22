<?php
// Include the database connection
include 'db.php';

// Query to get user statistics
$sql = "SELECT COUNT(*) AS total_users,
               SUM(CASE WHEN active = 1 THEN 1 ELSE 0 END) AS active_users,
               SUM(CASE WHEN active = 0 THEN 1 ELSE 0 END) AS inactive_users
        FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(array());
}

$conn->close();
?>
