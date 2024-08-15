<?php
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit;
}

// Get hall ID from URL
$id = $_GET["id"];

// Get hall details from database
$sql = "SELECT * FROM halls WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$hall = mysqli_fetch_assoc($result);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $capacity = $_POST["capacity"];
  $location = $_POST["location"];

  // Update hall in database
  $sql = "UPDATE halls SET name = '$name', capacity = '$capacity', location = '$location' WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "Hall updated successfully!";
  } else {
    echo "Error updating hall: " . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Hall</title>
</head>
<body>
  <h1>Edit Hall</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $hall["name"]; ?>" required>
    <br>
    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" value="<?php echo $hall["capacity"]; ?>" required>
    <br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="<?php echo $hall["location"]; ?>" required>
    <br>
    <input type="submit" value="Update Hall">
  </form>
</body>
</html>