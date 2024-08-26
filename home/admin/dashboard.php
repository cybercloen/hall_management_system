<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            display: flex;
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

        .container {
            margin-left: 220px; 
            width: calc(100% - 220px);
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 20px;
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            grid-gap: 20px;
            margin-bottom: 20px;
            width: 100%;
        }

        .button {
            background-color: #4a90e2;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-weight: bold;
        }

        .button:hover {
            background-color: #357ab8;
        }

        .button:active {
            transform: translateY(2px);
        }

        .script-display {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            width: 100%;
            max-width: 600px;
            white-space: pre-wrap; 
            overflow-x: auto; 
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .button-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="./add_hall.php">Add Hall</a>
        <a href="./view_hall.php">Manage Halls</a>
        <a href="./add_event.php">Add Event</a>
        <a href="./manage-events.php">Manage Events</a>
        <a href="./view_bookings.php">View Bookings</a>
        <a href="./view_hall_bookings.php">View Hall Bookings</a>
        <a href="./view_hall.php">View Hall Availability</a>
        <a href="./view_hall_statistics.php">View Hall Statistics</a>
        <a href="./view_bookings.php">All Bookings</a>
        <a href="./view_users.php">View All Users</a>
        <a href="./settings.php">Settings</a>
        <a href="./logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <div class="script-display" id="scriptDisplay">
            <!-- PHP script will be displayed here -->
        </div>
    </div>
    <script>
        function displayScript(scriptName) {
            const scriptDisplay = document.getElementById('scriptDisplay');
            fetch(scriptName)
                .then(response => response.text())
                .then(data => {
                    scriptDisplay.textContent = data;
                })
                .catch(error => {
                    scriptDisplay.textContent = 'Error loading script: ' + error;
                });
        }
    </script>
</body>
</html>
// <?php
// // Check if the user is logged in
// if (!isset($_SESSION['admin_logged_in'])) {
//   header('Location: login.php');
//   exit;
// }
// ?>