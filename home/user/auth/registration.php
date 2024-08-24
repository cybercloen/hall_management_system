<?php
require_once 'db.php';

// Registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm_password"]);
    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $phone_number = test_input($_POST["phone_number"]);
    $address = test_input($_POST["address"]);



    function test_input($data){
        $data = trim($data);
        $data = stripslahes($data);
        $data = htmlspecialchar($data);
        return $data;
    }





    // Validate input
    $errors = [];
    if (empty($username)) {
        $errors[] = "Please fill in the username field.";
    }
    if (empty($email)) {
        $errors[] = "Please fill in the email field.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (empty($password)) {
        $errors[] = "Please fill in the password field.";
    } elseif ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (empty($first_name)) {
        $errors[] = "Please fill in the first name field.";
    }
    if (empty($last_name)) {
        $errors[] = "Please fill in the last name field.";
    }
    if( !empty($phone_number) ) 
        {
            $pattern = '/^(?:\(\+?44\)\s?|\+?44 ?)?(?:0|\(0\))?\s?(?:(?:1\d{3}|7[1-9]\d{2}|20\s?[78])\s?\d\s?\d{2}[ -]?\d{3}|2\d{2}\s?\d{3}[ -]?\d{4})$/';
            if(!preg_match($pattern, $phone_numner)){
                $error[] = 'Please enter a valid phone number!';
            }
    }
    if (empty($address)) {
        $errors[] = "Please fill in the address field.";
    }

    if (count($errors) > 0) {
        $error_message = implode("<br>", $errors);
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        $query = "INSERT INTO users (username, email, password, first_name, last_name, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $username, $email, $password_hash, $first_name, $last_name, $phone_number, $address);
        $stmt->execute();

        // Check if user was inserted successfully
        if ($stmt->affected_rows > 0) {
            $success_message = "Registration successful! You can now log in.";
            header('Location: login.php');
            exit;
        } else {
            $error_message = "Registration failed. Please try again.";
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
        <h2>Register</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)) : ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php else : ?>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br><br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br><br>
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" required><br><br>
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea><br><br>
                <input type="submit" value="Register">
            </form>
            <a href="login.html">Already have an account? Login here.</a>
        <?php endif; ?>
    </div>
</body>
</html>
