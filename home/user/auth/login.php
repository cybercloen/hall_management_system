<?php
session_start();
require_once 'db.php';

// Initialize error message variable
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data["password"])) {
            // Login successful, start session and redirect to dashboard
            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["email"] = $email;
            header("Location: ../dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }   
    } else {
        $error = "Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
