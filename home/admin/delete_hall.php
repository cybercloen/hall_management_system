<?php
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit;
}

// Get hall ID from URL
$id = $_GET["id"];

// Delete hall from database
$sql = "DELETE FROM halls WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Hall deleted successfully!";
} else {
  echo "Error deleting hall: " . mysqli_error($conn);
}

// Redirect to dashboard
header("location: dashboard.php");
?>