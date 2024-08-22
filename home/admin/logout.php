<?php
// Start session
session_start();

// Unset session variables
unset($_SESSION["loggedin"]);
unset($_SESSION["email"]);

// Redirect to login page
header("location: login.php");
?>