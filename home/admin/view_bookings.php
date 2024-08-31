<?php
session_start();

// Include database connection
require_once 'db.php'; // Ensure you include your database connection file

// Prepare SQL statement to get all bookings
$query = "
    SELECT b.*, h.name AS hall_name 
    FROM bookings b 
    JOIN halls h ON b.hall_id = h.hall_id
";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #00796b; /* Teal background for header */
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray for even rows */
        }

        tr:hover {
            background-color: #e0f2f1; /* Light teal on hover */
        }

        tr td {
            border-bottom: 1px solid #ddd; /* Divider between rows */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none; /* Hide headers on small screens */
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd; /* Border around each booking */
            }

            td {
                text-align: right;
                position: relative;
                padding-left: 50%; /* Space for labels */
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
            }
        }

        .sidebar {
            width: 200px; 
            background-color: #007BFF;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        // <a href="./add_event.php">Add Event</a>
        // <a href="./manage-events.php">Manage Events</a>
        <a href="./view_bookings.php">View Bookings</a>
        // <a href="./view_hall_bookings.php">View Hall Bookings</a>
        <a href="./view_event_bookings.php">View Event Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./logout.php">Logout</a>
    </div>

    <div style="margin-left: 220px;"> <!-- Adjust margin to accommodate sidebar -->
        <h1>All Bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>Hall Name</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td data-label="Hall Name"><?php echo htmlspecialchars($row['hall_name']); ?></td>
                        <td data-label="Booking Date"><?php echo htmlspecialchars($row['booking_date']); ?></td>
                        <td data-label="Booking Time"><?php echo htmlspecialchars($row['booking_time']); ?></td>
                        <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>
                        <td data-label="Action">
                            <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                <input type="submit" value="Cancel" style="background-color: #d32f2f; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">No bookings found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        // Free the result set
        mysqli_free_result($result);
        // Close the statement
        mysqli_stmt_close($stmt);
        // Close the database connection if needed
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
