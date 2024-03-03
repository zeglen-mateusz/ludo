<?php

require_once 'database.php';


$database = new Database();

// Get the database connection
$conn = $database->getConnection();

// Get the status from the POST data
$status = $_POST['status'];
$name = $_POST['nick'];
// Update the status in the database
$sql = "UPDATE users SET status = $status WHERE nick = '$name'"; // Change id to the appropriate identifier
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>