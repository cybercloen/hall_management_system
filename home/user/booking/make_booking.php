<!-- booking.php -->
<?php
require_once 'db.php';
if (!isset($_SESSION['user_logged_in'])) {
  header('Location: login.html');
  exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $hall_id = $_POST["hall_id"];
  $user_name = $_POST["user_name"];
  $user_email = $_POST["user_email"];
  $event_name = $_POST["event_name"];
  $event_date = $_POST["event_date"];
  $start_time = $_POST["start_time"];
  $end_time = $_POST["end_time"];

  // Validate form data
  if (empty($hall_id) || empty($user_name) || empty($user_email) || empty($event_name) || empty($event_date) || empty($start_time) || empty($end_time)) {
    $error = "Please fill in all fields.";
  } else {
    // Insert booking into database
    $sql = "INSERT INTO bookings (hall_id, user_name, user_email, event_name, event_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issssss", $hall_id, $user_name, $user_email, $event_name, $event_date, $start_time, $end_time);
    mysqli_stmt_execute($stmt);

    // Check if booking was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      $success = "Booking successful!";
    } else {
      $error = "Booking failed. Please try again.";
    }
  }
}

// Close database connection
mysqli_close($conn);
?>

<!-- Booking form -->
<html>
<head>
  <title>Book a Hall</title>
  <style>
    /* Global styles */

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f9f9f9;
}

h2 {
  margin-bottom: 20px;
  font-weight: bold;
  color: #337ab7;
}

/* Form styles */

form {
  max-width: 400px;
  margin: 40px auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
  color: #337ab7;
}

input[type="text"], input[type="email"], input[type="date"], input[type="time"] {
  width: 100%;
  height: 40px;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="submit"] {
  width: 100%;
  height: 40px;
  margin-top: 20px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #337ab7;
  color: #fff;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #23527c;
}

.error {
  color: #red;
  font-size: 14px;
  margin-bottom: 10px;
}

.success {
  color: #green;
  font-size: 14px;
  margin-bottom: 10px;
}
  </style>
</head>
<body>
  <h2>Book a Hall</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="hall_id">Hall ID:</label>
    <input type="number" id="hall_id" name="hall_id" required><br><br>
    <label for="user_name">Your Name:</label>
    <input type="text" id="user_name" name="user_name" required><br><br>
    <label for="user_email">Your Email:</label>
    <input type="email" id="user_email" name="user_email" required><br><br>
    <label for="event_name">Event Name:</label>
    <input type="text" id="event_name" name="event_name" required><br><br>
    <label for="event_date">Event Date:</label>
    <input type="date" id="event_date" name="event_date" required><br><br>
    <label for="start_time">Start Time:</label>
    <input type="time" id="start_time" name="start_time" required><br><br>
    <label for="end_time">End Time:</label>
    <input type="time" id="end_time" name="end_time" required><br><br>
    <input type="submit" value="Book Hall">
  </form>

  <!-- Display error or success message -->
  <?php if (isset($error)) { ?>
  <p style="color: red;"><?php echo $error; ?></p>
  <?php } elseif (isset($success)) { ?>
  <p style="color: green;"><?php echo $success; ?></p>
  <?php } ?>
</body>
</html>