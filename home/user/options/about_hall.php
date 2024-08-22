<?php
// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch hall details
$hall_id = intval($_GET['id']); // Get hall ID from URL
$sql = "SELECT image_url, name, description, key_features FROM halls WHERE id = $hall_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $hall = mysqli_fetch_assoc($result);
    $image_url = htmlspecialchars($hall['image_url']);
    $name = htmlspecialchars($hall['name']);
    $description = htmlspecialchars($hall['description']);
    $key_features = htmlspecialchars($hall['key_features']); // Assuming key_features is a comma-separated string
    $features_array = explode(',', $key_features); // Convert to array for display
} else {
    echo "No hall found.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Hall - <?php echo $name; ?></title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .navbar {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .navbar .logo {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .image-container {
            flex: 1;
            padding-right: 20px;
        }
        .image-container img {
            width: 100%;
            border-radius: 10px;
        }
        .description {
            flex: 2;
        }
        .description h2 {
            color: #2c3e50;
        }
        .key-features {
            margin-top: 20px;
            padding: 15px;
            background-color: #ecf0f1;
            border-radius: 5px;
        }
        .key-features h3 {
            margin: 0;
            color: #e74c3c;
        }
        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">Hall Management System</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Hall Details</a></li>
                <li><a href="#">Booking Status</a></li>
                <li><a href="#">Hall Booking</a></li>
                <li><a href="login.html" class="button2">Sign In</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="image-container">
            <img src="<?php echo $image_url; ?>" alt="Hall Image">
        </div>
        <div class="description">
            <h2><?php echo $name; ?></h2>
            <p><?php echo $description; ?></p>
            
            <div class="key-features">
                <h3>Key Features:</h3>
                <ul>
                    <?php foreach ($features_array as $feature): ?>
                        <li><?php echo htmlspecialchars(trim($feature)); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Hall Management System. All rights reserved.</p>
    </footer>
</body>
</html>