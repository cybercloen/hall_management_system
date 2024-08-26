<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #C9961F;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Container Styles */
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        
        .form-control:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Button Styles */
        .btn-submit {
            background-color: #C9961F;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn-submit:hover {
            background-color: #1E3EDD;
        }
    </style>
</head>
<body>
     <div class="sidebar">
        <h2>Admin Menu</h2>
      <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        <a href="./add_event.php">Add Event</a>
        <a href="./manage-events.php">Manage Events</a>
        <a href="./view_bookings.php">View Bookings</a>
        <a href="./view_hall_bookings.php">View Hall Bookings</a>
        <a href="./view_event_bookings.php">View Event Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_bookings.php">All Bookings</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./logout.php">Logout</a>
    </div>
    </div>
    <div class="navbar">
        <h1>Admin Panel</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Admin Settings</h2>
        <form action="update_settings.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Update Settings" class="btn-submit">
        </form>
    </div>
</body>
</html>
