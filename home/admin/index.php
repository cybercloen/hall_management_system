<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2453EF;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Container Styles */
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        
        .form-control:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Button Styles */
        .btn-submit {
            background-color: #C9961F;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn-submit:hover {
            background-color: #0F3CCF;
        }
        
        /* Link Styles */
        a {
            text-decoration: none;
            color: #337ab7;
        }
        
        a:hover {
            color: #23527c;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Admin Panel</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="view_users">Users</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Admin Login</h2>
        <form action="check_login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Login" class="btn-submit">
            <p><a href="register.php">Create an admin account</a></p>
        </form>
    </div>
</body>
</html>
