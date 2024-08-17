<?php
session_start();

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // update user profile information in database
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];

  $query = "UPDATE users SET email = '$email', phone_number = '$phone_number', address = '$address' WHERE id = '$user_id'";
  mysqli_query($conn, $query);

  header('Location: user_profile.php');
  exit;
} else {
  header('Location: login.php');
  exit;
}
?>