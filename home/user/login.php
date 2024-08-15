<!-- login.php -->
<?php
session_start();

require_once 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to retrieve user data
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data["password"])) {
            // Login successful, start session and redirect to dashboard
            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["email"] = $email;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } else {
            $error = "Invalid email or password";
    }
}

$conn->close();
?>

<!-- Display error message if any -->
<?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php } ?>

<!-- Redirect back to login form -->
<form action="login.html" method="post">
    <button type="submit">Back to login</button>
</form>
