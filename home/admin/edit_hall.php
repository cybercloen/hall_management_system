<?php
require_once 'db.php';

// Check if ID is set
if (isset($_GET['id'])) {
    $hallId = intval($_GET['id']);
    
    // Retrieve hall details from the database
    $sql = "SELECT * FROM halls WHERE id = $hallId";
    $result = mysqli_query($conn, $sql);
    $hall = mysqli_fetch_assoc($result);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update hall details
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $capacity = intval($_POST['capacity']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $interior_image_url = mysqli_real_escape_string($conn, $_POST['interior_image_url']);
        $exterior_image_url = mysqli_real_escape_string($conn, $_POST['exterior_image_url']);

        $updateSql = "UPDATE halls SET name='$name', capacity=$capacity, location='$location', status='$status', interior_image_url='$interior_image_url', exterior_image_url='$exterior_image_url' WHERE id = $hallId";
        
        if (mysqli_query($conn, $updateSql)) {
            header("Location: admin_view_hall.php?id=$hallId"); // Redirect after successful update
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid hall ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Hall</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4ff;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Hall</h1>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($hall['name']); ?>" required><br>
            <label>Capacity:</label>
            <input type="number" name="capacity" value="<?= htmlspecialchars($hall['capacity']); ?>" required><br>
            <label>Location:</label>
            <input type="text" name="location" value="<?= htmlspecialchars($hall['location']); ?>" required><br>
            <label>Status:</label>
            <input type="text" name="status" value="<?= htmlspecialchars($hall['status']); ?>" required><br>
            <label>Interior Image URL:</label>
            <input type="text" name="interior_image_url" value="<?= htmlspecialchars($hall['interior_image_url']); ?>"><br>
            <label>Exterior Image URL:</label>
            <input type="text" name="exterior_image_url" value="<?= htmlspecialchars($hall['exterior_image_url']); ?>"><br>
            <button type="submit">Update Hall</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
