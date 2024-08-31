<?php
session_start();
// Uncomment the following lines if you want to enforce login
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit;
// }

// Include database connection
require_once 'db.php';

// Example query for statistics (adjust as necessary)
$query = "SELECT id, COUNT(*) as total_bookings FROM halls GROUP BY id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hall Statistics</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 200px; 
            background-color: #007BFF; /* Primary blue color */
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
            padding: 10px; 
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 600;
            font-size: 0.9em; 
        }

        .sidebar a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .container {
            margin-left: 220px; /* Space for sidebar */
            padding: 20px;
        }

        h1 {
            color: #007BFF; /* Primary blue color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF; /* Primary blue color */
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1; /* Light grey on row hover */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        <a href="./view_bookings.php">View Bookings</a>
        <a href="./view_hall_bookings.php">View Hall Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_bookings.php">All Bookings</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./#">Calendar</a>
        <a href="./logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Hall Statistics</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Total Bookings</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['total_bookings']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
