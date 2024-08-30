<?php
session_start();

// Check if user is logged in as admin
// if (!isset($_SESSION["admin_id"])) {
//     header("Location: login.html");
//     exit;
// }

// Connect to database
require_once 'db.php';

// Check for database connection errors
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

// Get the hall ID and new status from the POST request
$id = $_POST['id'];
$status = $_POST['status'];

// Prepare and execute the SQL statement to update the hall status
$stmt = $conn->prepare("UPDATE halls SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

// Redirect back to the admin dashboard
header("Location: view_hall.php");
exit;

// Close the statement and connection
$stmt->close();
$conn->close();
?>
