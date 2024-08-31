<?php
require_once 'db.php';

// Check if the user is logged in
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit;
// }

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $capacity = $_POST["capacity"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $rental_per_day = $_POST["rental_per_day"];

    // Handle file uploads
    $interior_image_url = uploadFile($_FILES["interior_image"]);
    $exterior_image_url = uploadFile($_FILES["exterior_image"]);

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

function uploadFile($file) {
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    // Check file size (limit to 5MB)
    if ($file["size"] > 5000000) {
        return "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; // Return the path of the uploaded file
    } else {
        return "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-color: #f0f4ff;
        }
        /* Sidebar Styles */
        .sidebar {
            width: 200px;
            background-color: #007BFF;
            color: white;
            position: fixed;
            height: 100%;
            padding: 20px;
        }
        .sidebar h2 {
            margin-bottom: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        /* Add Hall Page Styles */
        .add-hall-page {
            margin-left: 220px; /* Leave space for sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .add-hall-form {
            width: 500px;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .add-hall-form h1 {
            margin-top: 0;
            font-weight: bold;
            color: #007BFF;
            text-align: center;
        }
        .add-hall-form label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        .add-hall-form input[type="text"],
        .add-hall-form input[type="number"],
        .add-hall-form input[type="file"] {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #007BFF;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        .add-hall-form input[type="text"]:focus,
        .add-hall-form input[type="number"]:focus {
            border-color: #0056b3;
            outline: none;
        }
        .add-hall-form input[type="submit"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .add-hall-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        <a href="./manage-events.php">Manage Events</a>
        <a href="./view_bookings.php">View Bookings</a>
        <a href="./view_hall_bookings.php">View Hall Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_bookings.php">All Bookings</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./logout.php">Logout</a>
    </div>
    <div class="add-hall-page">
        <div class="add-hall-form">
            <h1>Add Hall</h1>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required>
                
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                
                <label for="interior_image">Interior Image:</label>
                <input type="file" id="interior_image" name="interior_image" accept="image/*" required>
                
                <label for="exterior_image">Exterior Image:</label>
                <input type="file" id="exterior_image" name="exterior_image" accept="image/*" required>
                
                <label for="rental_per_day">Rental Per Day:</label>
                <input type="text" id="rental_per_day" name="rental_per_day" required>
                
                <input type="submit" value="Add Hall">
            </form>
        </div>
    </div>
</body>
</html>
