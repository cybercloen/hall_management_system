<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="index.css">
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
                <!-- <li><a href="#" class="button3">Sign Out</a></li> -->
            </ul>
        </div>
         <div class="search">
            <input class="srch" type="search" name="" placeholder="Type To text">
            <a href="search_hall.php"><button class="btn">Search</button></a>
        </div>
    </div>
    <div class="content">
        <h1>Create unforgettable memories<br><span>in our stunning</span> <br>Event spaces</h1>
        <p class="par">Celebrate in style
            <br>Book our luxurious hall for your next event</p>

        <!-- Display halls -->
        <div class="halls">
            <h2>View Halls</h2>
            <ul>
                <?php
                // Retrieve halls from database
                $conn = mysqli_connect("localhost", "username", "password", "database_name");
                $sql = "SELECT * FROM halls LIMIT 3"; // Display 3 halls
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<h3>" . $row["name"] . "</h3>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<a href='hall_details.php?id=" . $row["id"] . "'>View More</a>";
                    echo "</li>";
                }

                mysqli_close($conn);
                ?>
            </ul>
            <a href="view_more_halls.php">View More Halls</a>
        </div>

    </div>
</div>
</body>
</html>