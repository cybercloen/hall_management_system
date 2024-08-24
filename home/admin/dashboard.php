<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-around;
            background-color: #337ab7;
            padding: 5px;  /* Reduced padding */
            border-radius: 5px;
            margin-bottom: 15px;  /* Reduced margin */
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;  /* Reduced font size */
            padding: 8px 10px;  /* Reduced padding on links */
        }

        .navbar a:hover {
            background-color: #23527c;
            border-radius: 5px;
        }

        .navbar a:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="navbar">
            <a href="add_hall.php">Add Hall</a>
            <a href="view_hall.php">Manage Halls</a>
            <a href="add-event.php">Add Event</a>
            <a href="manage-events.php">Manage Events</a>
            <a href="view_bookings.php">View Bookings</a>
            <a href="logout.php">Logout</a>
            <a href="change_password.php">Change Password</a>
            <a href="view_hall_bookings.php">View Hall Bookings</a>
            <a href="view_event_bookings.php">View Event Bookings</a>
            <a href="view_hall_availability.php">View Hall Availability</a>
            <a href="view_hall_statistics.php">View Hall Statistics</a>
            <a href="view_users.php">View All Users</a>
        </div>
    </div>
</body>
</html>
