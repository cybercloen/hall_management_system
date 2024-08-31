<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
    // Retrieve user information from session
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    // Connect to database (make sure to include your db connection file)
    require_once 'db.php';

    // Retrieve user profile information from database
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    // Check if user data is found
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Profile</title>
            <link rel="stylesheet" href="styles.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f8ff; /* Light background */
                    color: #333;
                    margin: 0;
                    display: flex; /* Use flexbox for layout */
                }

                .sidebar {
                    width: 200px;
                    background-color: #007bff; /* Blue sidebar */
                    padding: 15px;
                    color: white;
                }

                .sidebar h2 {
                    color: white;
                }

                .sidebar a {
                    color: white;
                    text-decoration: none;
                    display: block;
                    margin: 10px 0;
                }

                .sidebar a:hover {
                    text-decoration: underline;
                }

                .content {
                    flex: 1; /* Take the remaining space */
                    padding: 20px;
                }

                h1 {
                    color: #007bff; /* Blue color for headings */
                    text-align: center;
                }

                p {
                    font-size: 1.1em;
                    line-height: 1.5;
                }

                form {
                    text-align: center;
                    margin-top: 20px;
                }

                input[type="submit"] {
                    background-color: #007bff; /* Blue button */
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                input[type="submit"]:hover {
                    background-color: #0056b3; /* Darker blue on hover */
                }
            </style>
        </head>
        <body>
            <div class="sidebar">
                <h2>User Options</h2>
                <a href="../dashboard.php">Dashboard</a>
                <a href="../booking/view_bookings.php">My Bookings</a>
                <a href="../profile/user_profile.php">Profile</a>
                <a href="#">Settings</a>
                <a href="../auth/logout.php">Logout</a>
                <!-- Add more links as needed -->
            </div>

            <div class="content">
                <h1>User Profile</h1>
                <p>Username: <?php echo htmlspecialchars($username); ?></p>
                <p>Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
                <p>Phone Number: <?php echo htmlspecialchars($user_data['phone_number']); ?></p>
                <p>Address: <?php echo htmlspecialchars($user_data['address']); ?></p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "User data not found.";
    }
} else {
    header('Location: login.php');
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
