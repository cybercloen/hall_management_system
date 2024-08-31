<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

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

// Display user dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Light sky blue background */
            color: #333;
            margin: 0;
            display: flex;
        }

        h1 {
            text-align: center;
            color: #00796b; /* Darker teal for headings */
            margin-bottom: 20px;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #007bff; /* Blue theme */
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            color: white;
            margin: 0 0 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .main-content {
            margin-left: 270px; /* Space for sidebar */
            padding: 20px;
            flex-grow: 1;
        }

        .welcome-text {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #00796b; /* Darker teal for welcome text */
        }

        .scroll-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .hall-card {
            background-color: #ffffff; /* White background for cards */
            border-radius: 15px; /* Rounded borders */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px; /* Adjusted width for square aspect */
            height: 300px; /* Increased height for better layout */
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .hall-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .hall-card img {
            width: 100%;
            height: 150px; /* Fixed height for images */
            object-fit: cover; /* Ensures images cover the area */
        }

        .hall-info {
            padding: 10px;
            flex-grow: 1; /* Allow info section to take remaining space */
        }

        .hall-info h2 {
            color: #00796b; /* Darker teal for hall names */
            margin: 0 0 5px;
            font-size: 1.1em; /* Slightly smaller */
        }

        .hall-info p {
            margin: 3px 0;
            line-height: 1.5; /* Improved spacing for readability */
        }

        .hall-info .capacity {
            font-weight: bold;
            color: #d32f2f; /* Red for capacity */
        }

        .book-button {
            background-color: #007bff; /* Blue button */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .book-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .hall-card {
                width: 90%; /* Full width on smaller screens */
                height: auto; /* Adjust height */
            }
            
            .sidebar {
                position: relative; /* Make sidebar relative on small screens */
                height: auto; /* Adjust height */
            }

            .main-content {
                margin-left: 0; /* Remove margin on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>User Options</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="./booking/view_bookings.php">My Bookings</a>
        <a href="./profile/user_profile.php">Profile</a>
        <a href="#">Settings</a>
        <a href="./auth/logout.php">Logout</a>
        <!-- Add more links as needed -->
    </div>
    
    <div class="main-content">
        <h1>All Halls</h1>
        <div class="welcome-text">
            Welcome, Here are the available halls:
        </div>
        <div class="scroll-container">
            <?php while ($hall = $result->fetch_assoc()) { ?>
                <div class="hall-card">
                    <img src="hall_images/<?php echo htmlspecialchars($hall["id"]); ?>.jpg" alt="<?php echo htmlspecialchars($hall["name"]); ?>">
                    <div class="hall-info">
                        <h2><?php echo htmlspecialchars($hall["name"]); ?></h2>
                        <p>Location: <?php echo htmlspecialchars($hall["location"]); ?></p>
                        <p class="capacity">Capacity: <?php echo htmlspecialchars($hall["capacity"]); ?></p>
                        <p>Description: <?php echo htmlspecialchars($hall["description"]); ?></p>
                        <p>Status: <?php echo htmlspecialchars($hall["status"]); ?></p> <!-- Display status -->
                       <a href="./booking/make_booking.php?hall_id=<?php echo htmlspecialchars($hall['id']); ?>" class="book-button">Book Now</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function reserveHall(hallId) {
            // Simulate a reservation process
            const reservationNumber = Math.floor(Math.random() * 10000); // Generate a random reservation number
            alert("You have successfully reserved Hall ID: " + hallId + "\nReservation Number: " + reservationNumber);
            // Here you could also send an AJAX request to save the reservation in the database
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>
