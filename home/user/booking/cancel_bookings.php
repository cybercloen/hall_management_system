<?php
session_start();

// Include database connection
require_once 'db.php'; // Ensure you include your database connection file

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
        $booking_id = intval($_POST['booking_id']);
        
        // Prepare SQL statement to prevent SQL injection
        $query = "DELETE FROM bookings WHERE booking_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $booking_id, $_SESSION['user_id']);
        
        if (mysqli_stmt_execute($stmt)) {
            // Successfully canceled
            $_SESSION['message'] = "Booking canceled successfully.";
        } else {
            // Error occurred
            $_SESSION['message'] = "Error canceling booking. Please try again.";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Invalid request.";
    }
} else {
    header('Location: login.php');
    exit;
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the bookings page
header('Location: view_bookings.php'); // Adjust this to your actual bookings page
exit;
?>
