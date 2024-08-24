<?php
require_once 'db.php';

// Registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        $query = "INSERT INTO admins (email, password, name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $password_hash, $name);

        try {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $success = "Registration successful! You can now log in.";
                header("Location:index.php");
                exit;
            } else {
                $error = "Registration failed. Please try again.";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}

// Close connection
$conn->close();
?>

<!-- Registration form -->
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h2>Admin Register</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>
            <!-- Remove the address field if you're not using it -->
            <!-- <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea><br><br> -->
            <input type="submit" value="Register">
        </form>
        <p> Already have an account?<a href="login.php"> Login here.</a></p>
    </div>
</body>
</html>