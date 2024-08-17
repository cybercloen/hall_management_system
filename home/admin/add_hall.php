<?php
require_once 'db.php';

//Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit;
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $capacity = $_POST["capacity"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $interior_image_url = $_POST["interior_image_url"];
    $exterior_image_url = $_POST["exterior_image_url"];
    $rental_per_day = $_POST["rental_per_day"];

    // Insert hall into database
    $stmt = $conn->prepare("INSERT INTO halls (name, capacity, location, description, interior_image_url, exterior_image_url, rental_per_day) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $capacity, $location, $description, $interior_image_url, $exterior_image_url, $rental_per_day);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Hall added successfully!";
        header('Location: view_hall.php');
        exit;
    } else {
        echo "Error adding hall: " . $stmt->error;
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Hall</title>
  <style>
    /* Global Styles */

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

    /* Add Hall Page Styles */

    .add-hall-page {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .add-hall-form {
      width: 500px;
      padding: 40px;
      background-color: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .add-hall-form h1 {
      margin-top: 0;
      font-weight: bold;
      color: #333;
    }

    .add-hall-form label {
      display: block;
      margin-bottom: 10px;
    }

    .add-hall-form input[type="text"], .add-hall-form input[type="number"] {
      width: 100%;
      height: 40px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
    }

    .add-hall-form input[type="submit"] {
      width: 100%;
      height: 40px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #337ab7;
      color: #fff;
      cursor: pointer;
    }

    .add-hall-form input[type="submit"]:hover {
      background-color: #23527c;
    }

    /* Error Message Styles */

    .error-message {
      color: #red;
      font-size: 14px;
      margin-bottom: 10px;
    }

    /* Session Message Styles */

    .session-message {
      color: #green;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="add-hall-page">
    <div class="add-hall-form">
      <h1>Add Hall</h1>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" required>
        <br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        <br>
    <br>
    <label for="location">Interior image url:</label>
    <input type="text" id="interior_image_url" name="interior_image_url" required>
    <br>
    <br>
    <label for="location">Exterior image url:</label>
    <input type="text" id="exterior_image_url" name="exterior_image_url" required>
    <br>
    <br>
    <label for="location">Rental per day:</label>
    <input type="text" id="rental_per_day" name="rental_per_day" required>
    <br>
    <input type="submit" value="Add Hall">
  </form>
</body>
</html>