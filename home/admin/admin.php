<?php
require_once 'db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Get the list of halls
$stmt = mysqli_prepare($conn, "SELECT * FROM halls");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check for database errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Render the template
include 'dashboard.php';