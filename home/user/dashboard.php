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
  die("Database connection error: " . mysqli_connect_error());
}

// Get all halls with their details
$sql = "SELECT * FROM halls";
$result = mysqli_query($conn, $sql);

// Check for SQL query errors
if (!$result) {
  die("SQL error: " . mysqli_error($conn));
}

// Display user dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e0f7fa; /* Light sky blue background */
      color: #333;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #00796b; /* Darker teal for headings */
    }

    .scroll-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .hall-card {
      background-color: #ffffff; /* White background for cards */
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 300px;
      transition: transform 0.3s;
    }

    .hall-card:hover {
      transform: translateY(-5px);
    }

    .hall-card img {
      width: 100%;
      height: auto;
    }

    .hall-info {
      padding: 15px;
    }

    .hall-info h2 {
      color: #00796b; /* Darker teal for hall names */
      margin: 0 0 10px;
    }

    .hall-info p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <h1>All Halls</h1>
  <div class="scroll-container">
    <?php while ($hall = mysqli_fetch_assoc($result)) { ?>
    <div class="hall-card">
      <img src="hall_images/<?php echo htmlspecialchars($hall["hall_id"]); ?>.jpg" alt="<?php echo htmlspecialchars($hall["hall_name"]); ?>">
      <div class="hall-info">
        <h2><?php echo htmlspecialchars($hall["hall_name"]); ?></h2>
        <p>Location: <?php echo htmlspecialchars($hall["location"]); ?></p>
        <p>Capacity: <?php echo htmlspecialchars($hall["capacity"]); ?></p>
        <p>Description: <?php echo htmlspecialchars($hall["description"]); ?></p>
      </div>
    </div>
    <?php } ?>
  </div>
</body>
</html>
