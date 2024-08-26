<?php
// delete_user.php - File to handle user deletion 

require 'db.php'; // Include your database connection

function getUser($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteUser($userId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

// Check if user ID is provided
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = getUser($userId);

    // If user exists, show confirmation
    if ($user) {
        if (isset($_POST['confirm'])) {
            // If confirmed, delete the user
            if (deleteUser($userId)) {
                echo "<p style='color: green;'>User deleted successfully.</p>";
            } else {
                echo "<p style='color: red;'>Failed to delete user.</p>";
            }
        } else {
            // Show confirmation form
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Delete User Confirmation</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f0f8ff; /* Light blue background */
                        color: #333;
                        margin: 0;
                        padding: 20px;
                    }
                    h1 {
                        color: #007bff; /* Primary blue color */
                    }
                    ul {
                        list-style-type: none;
                        padding: 0;
                    }
                    li {
                        margin: 5px 0;
                    }
                    button {
                        background-color: #007bff; /* Primary blue color */
                        color: white;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        border-radius: 5px;
                    }
                    button:hover {
                        background-color: #0056b3; /* Darker blue on hover */
                    }
                    a {
                        text-decoration: none;
                        color: #007bff; /* Primary blue color */
                        margin-left: 10px;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                </style>
            </head>
            <body>
                <h1>Delete User Confirmation</h1>
                <p>Are you sure you want to delete the following user?</p>
                <ul>
                    <li>ID: <?php echo htmlspecialchars($user['id']); ?></li>
                    <li>Name: <?php echo htmlspecialchars($user['name']); ?></li>
                    <li>Email: <?php echo htmlspecialchars($user['email']); ?></li>
                </ul>
                <form method="post">
                    <button type="submit" name="confirm">Yes, delete this user</button>
                    <a href="user_list.php">No, go back</a>
                </form>
            </body>
            </html>
            <?php
        }
    } else {
        echo "<p style='color: red;'>User not found.</p>";
    }
} else {
    echo "<p style='color: red;'>No user ID provided.</p>";
}
?>
