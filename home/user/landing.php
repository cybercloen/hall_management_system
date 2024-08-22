<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Hall Management System</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .navbar .logo {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .menu ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }
        .menu a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .menu a:hover {
            color: #f39c12;
        }
        .menu a.button2 {
            background-color: #e74c3c;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a.button2:hover {
            background-color: #c0392b;
        }
        .search {
            display: flex;
            align-items: center;
        }
        .srch {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
            transition: border-color 0.3s;
        }
        .srch:focus {
            border-color: #e74c3c;
            outline: none;
        }
        .btn {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #34495e;
        }
        .content {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(to bottom right, #ecf0f1, #bdc3c7);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .content h1 {
            font-size: 2.5em;
            margin: 0;
            color: #2c3e50;
        }
        .content h1 span {
            color: #e74c3c;
        }
        .par {
            font-size: 1.2em;
            margin: 20px 0;
            color: #34495e;
        }
        .highlight {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.3em;
        }
        .halls {
            margin-top: 40px;
            text-align: left;
            width: 100%;
            max-width: 800px;
        }
        .halls h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }
        .halls ul {
            list-style: none;
            padding: 0;
        }
        .halls li {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .halls li:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .halls a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }
        .halls a:hover {
            text-decoration: underline;
        }
        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">WELCOME</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Hall Details</a></li>
                <li><a href="#">Booking Status</a></li>
                <li><a href="#">Hall Booking</a></li>
                <li><a href="login.html" class="button2">Sign In</a></li>
            </ul>
        </div>
        <div class="search">
            <input class="srch" type="search" placeholder="Search for halls...">
            <a href="search_hall.php"><button class="btn">Search</button></a>
        </div>
    </div>
    <div class="content">
        <h1>Create unforgettable memories<br><span>in our stunning</span> <br>Event spaces</h1>
        <p class="par">Celebrate in style<br>Book our luxurious hall for your next event</p>
        <p class="highlight">Experience elegance, comfort, and exceptional service at every event!</p>
        <p class="highlight">Join us for a journey of celebration and joy!</p>

        <!-- Display halls -->
        <div class="halls">
            <h2>View Halls</h2>
            <ul>
                <?php
                // Retrieve halls from database
                $conn = mysqli_connect("localhost", "username", "password", "database_name");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT * FROM halls LIMIT 3"; // Display 3 halls
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<h3>" . htmlspecialchars($row["name"]) . "</h3>";
                    echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                    echo "<a href='hall_details.php?id=" . intval($row["id"]) . "'>View More</a>";
                    echo "</li>";
                }

                mysqli_close($conn);
                ?>
            </ul>
            <a href="view_more_halls.php">View More Halls</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Hall Management System. All rights reserved.</p>
    </footer>
</div>
</body>
</html>