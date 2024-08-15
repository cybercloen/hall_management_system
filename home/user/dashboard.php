<!-- dashboard.php -->

<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: login.html");
  exit;
}

// Connect to database
require_once 'db.php';

// Check for database connection errors
if (!$conn) {
  echo "Database connection error: " . mysqli_connect_error();
  exit;
}

// Get user's bookings
$sql = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);

// Check for SQL query errors
if (!$stmt) {
  echo "SQL error: " . mysqli_error($conn);
  exit;
}

$result = mysqli_stmt_get_result($stmt);

// Display user dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>User Dashboard</h1>
  <div class="scroll-container">
    <?php while ($booking = mysqli_fetch_assoc($result)) { ?>
    <div class="hall-card">
      <img src="hall_images/<?php echo $booking["hall_id"]; ?>.jpg" alt="<?php echo $booking["hall_name"]; ?>">
      <div class="hall-info">
        <h2><?php echo $booking["hall_name"]; ?></h2>
        <p>Event Name: <?php echo $booking["event_name"]; ?></p>
        <p>Event Date: <?php echo $booking["event_date"]; ?></p>
        <p>Start Time: <?php echo $booking["start_time"]; ?></p>
        <p>End Time: <?php echo $booking["end_time"]; ?></p>
      </div>
    </div>
    <?php } ?>
  </div>
</body>
</html>