<?php
session_start();

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
  $username = $_SESSION['username'];

  // retrieve users from database
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);

  ?>
  <h1>View Users</h1>
  <table>
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['role']; ?></td>
    </tr>
    <?php } ?>
  </table>

  <?php
} else {
  header('Location: admin_login.php');
  exit;
}
?>