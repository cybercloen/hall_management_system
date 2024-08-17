<?php
session_start();

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // retrieve user profile information from database
  $query = "SELECT * FROM users WHERE id = '$user_id'";
  $result = mysqli_query($conn, $query);
  $user_data = mysqli_fetch_assoc($result);

  ?>
  <h1>User Profile</h1>
  <p>Username: <?php echo $username; ?></p>
  <p>Email: <?php echo $user_data['email']; ?></p>
  <p>Phone Number: <?php echo $user_data['phone_number']; ?></p>
  <p>Address: <?php echo $user_data['address']; ?></p>

  <form action="edit_profile.php" method="post">
    <input type="submit" value="Edit Profile">
  </form>

  <form action="change_password.php" method="post">
    <input type="submit" value="Change Password">
  </form>

  <?php
} else {
  header('Location: login.php');
  exit;
}
?>