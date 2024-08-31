<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hall_id = $_POST['hall_id'];
    $username = $_POST['username'];
    $booking_date = $_POST['booking_date'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (hall_id, username, booking_date) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iss', $hall_id, $username, $booking_date);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Hall booked successfully!</p>";
    } else {
        echo "<p>Error booking hall: " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Hall</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff; /* Blue primary color */
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff; /* Blue primary color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3; /* Darker blue */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book Hall</h1>
        <form action="" method="POST">
            <input type="hidden" name="hall_id" value="<?= htmlspecialchars($_GET['id']); ?>">
            <div class="form-group">
                <label for="username">Your Name:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date:</label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>
            <button type="submit">Book Hall</button>
        </form>
    </div>
</body>
</html>
