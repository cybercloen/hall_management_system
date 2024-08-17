<?php
session_start();

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // cancel booking in database
  $booking_id = $_GET['booking_id'];

  $query = "UPDATE bookings SET status = 'cancelled' WHERE id = '$booking_id'";
  mysqli_query($conn, $query);

  header('Location: view_bookings.php');
  exit;
} else {
  header('Location: login.php');
  exit;
}
?>