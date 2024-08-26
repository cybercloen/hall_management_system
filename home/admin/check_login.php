<?php
session_start();
require_once 'db.php';

// Check for a valid database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("SQL prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true; // Store login status in session
        header("Location: dashboard.php");
        exit; // Stop script execution
    } else {
        // Use JavaScript to show an alert for invalid credentials
        echo '<script>alert("Invalid email or password."); window.location.href="index.php";</script>';
        exit; // Stop script execution
    }
}

$conn->close();
?>
