<?php
session_start();

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // update user password in database
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // check if old password is correct
  $query = "SELECT password FROM users WHERE id = '$user_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $hashed_password = $row['password'];

  if (password_verify($old_password, $hashed_password)) {
    // update password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$user_id'";
    mysqli_query($conn, $query);

    header('Location: user_profile.php');
    exit;
  } else {
    echo "Old password is incorrect";
  }
} else {
  header('Location: login.php');
  exit;
}
?>