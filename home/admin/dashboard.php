<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
  <title>Admin Dashboard</title>
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

    .button-container {
      display: grid;
      grid-tempalte-columns: repeat(4, 1fr);
      grid-gap: 20px;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .button {
      background-color: #337ab7;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }

    .button:hover {
      background-color: #23527c;
    }

    .button:active {
      transform: translateY(2px);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Dashboard</h1>
    <div class="button-container">
      <button class="button" onclick="location.href='add_hall.php'">Add Hall</button>
      <button class="button" onclick="location.href='view_hall.php'">Manage Halls</button>
      <button class="button" onclick="location.href='add-event.php'">Add Event</button>
      <button class="button" onclick="location.href='manage-events.php'">Manage Events</button>
      <button class="button" onclick="location.href='view_bookings.php'">View Bookings</button>
      <button class="button" onclick="location.href='logout.php'">Logout</button>
      <button class="button" onclick="location.href='change_password.php'">Change Password</button>
      <button class="button" onclick="location.href='view_hall_bookings.php'">View Hall Bookings</button>
      <button class="button" onclick="location.href='view_event_bookings.php'">View Event Bookings</button>
      <button class="button" onclick="location.href='view_hall_availability.php'">View Hall Availability</button>
      <button class="button" onclick="location.href='view_hall_statistics.php'">View Hall Statistics</button>
      <button class="button" onclick="location.href='view_users.php'">View All Users</button>
    </div>
  </div>
</body>
</html>