<?php
// Start session
session_start();

// Check if user is logged in as admin
// if (!isset($_SESSION["admin_id"])) {
//     header("Location: index.php");
//     exit;
// }

// Connect to database
require_once 'db.php';

// Check for database connection errors
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

// Prepare and execute the SQL statement to get all halls
$stmt = $conn->prepare("SELECT * FROM halls");
$stmt->execute();
$result = $stmt->get_result();

// Display admin dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            display: flex;
        }

        h1 {
            text-align: center;
            color: #00796b;
            flex: 1; /* Allow header to take available space */
        }

        .sidebar {
            width: 200px; 
            background-color: #4a90e2;
            padding: 15px; 
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            border-radius: 0 10px 10px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 15px; 
            font-size: 1.5em; 
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 8px; 
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 600;
            font-size: 0.9em; 
        }

        .sidebar a:hover {
            background-color: #357ab8;
        }

        .main-content {
            margin-left: 220px; /* Space for sidebar */
            padding: 20px;
            flex-grow: 1; /* Allow main content to take remaining space */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .status {
            font-weight: bold;
        }

        .available {
            color: green;
        }

        .booked {
            color: red;
        }

        .maintenance {
            color: orange;
        }

        .hall-image {
            width: 100px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Space between images */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        <a href="./view_bookings.php">View Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_bookings.php">All Bookings</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./settings.php">Settings</a>
        <a href="./logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Admin Dashboard</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Description</th>
                <th>Status</th>
                <th>Interior Image</th>
                <th>Exterior Image</th>
                <th>Action</th>
            </tr>
            <?php while ($hall = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($hall["id"]); ?></td>
                    <td><?php echo htmlspecialchars($hall["name"]); ?></td>
                    <td><?php echo htmlspecialchars($hall["location"]); ?></td>
                    <td><?php echo htmlspecialchars($hall["capacity"]); ?></td>
                    <td><?php echo htmlspecialchars($hall["description"]); ?></td>
                    <td class="status <?php echo htmlspecialchars($hall["status"]); ?>">
                        <?php echo htmlspecialchars(ucfirst($hall["status"])); ?>
                    </td>
                    <td>
                        <img src="<?php echo htmlspecialchars($hall["interior_image_url"]); ?>" alt="Interior Image" class="hall-image">
                    </td>
                    <td>
                        <img src="<?php echo htmlspecialchars($hall["exterior_image_url"]); ?>" alt="Exterior Image" class="hall-image">
                    </td>
                    <td>
                        <form method="POST" action="status_update.php">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($hall["id"]); ?>">
                            <select name="status">
                                <option value="available" <?php echo $hall["status"] == 'available' ? 'selected' : ''; ?>>Available</option>
                                <option value="booked" <?php echo $hall["status"] == 'booked' ? 'selected' : ''; ?>>Booked</option>
                                <option value="under maintenance" <?php echo $hall["status"] == 'under maintenance' ? 'selected' : ''; ?>>Under Maintenance</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
