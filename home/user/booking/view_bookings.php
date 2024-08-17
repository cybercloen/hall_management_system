<?php
session_start();

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // retrieve user bookings from database
  $query = "SELECT * FROM bookings WHERE user_id = '$user_id'";
  $result = mysqli_query($conn, $query);

  ?>
  <h1>View Bookings</h1>
  <table>
    <tr>
      <th>Hall Name</th>
      <th>Booking Date</th>
      <th>Booking Time</th>
      <th>Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['hall_name']; ?></td>
      <td><?php echo $row['booking_date']; ?></td>
      <td><?php echo $row['booking_time']; ?></td>
      <td><?php echo $row['status']; ?></td>
    </tr>
    <?php } ?>
  </table>

  <?php
} else {
  header('Location: login.php');
  exit;
}
?>