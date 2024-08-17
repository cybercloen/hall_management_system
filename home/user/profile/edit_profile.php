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
  <h1>Edit Profile</h1>
  <form action="update_profile.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>">

    <label for="phone_number">Phone Number:</label>
    <input type="tel" id="phone_number" name="phone_number" value="<?php echo $user_data['phone_number']; ?>">

    <label for="address">Address:</label>
    <textarea id="address" name="address"><?php echo $user_data['address']; ?></textarea>

    <input type="submit" value="Update Profile">
  </form>

  <?php
} else {
  header('Location: login.php');
  exit;
}
?>