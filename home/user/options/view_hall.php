<?php
require_once 'db.php';

// Retrieve all halls from the database
$sql = "SELECT * FROM halls";
$result = mysqli_query($conn, $sql);

// Check if there are any halls
if (mysqli_num_rows($result) > 0) {
    displayHalls($result);
} else {
    displayNoHalls();
}

function displayHalls($result) {
    ?>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* View Halls Page Styles */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            font-weight: bold;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            margin: 0 10px;
            text-decoration: none;
            color: #337ab7;
        }

        .actions a:hover {
            color: #23527c;
        }
    </style>
    <div class="container">
        <h1>Available Halls</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($hall = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($hall['id']); ?></td>
                    <td><?= htmlspecialchars($hall['name']); ?></td>
                    <td><?= htmlspecialchars($hall['capacity']); ?></td>
                    <td><?= htmlspecialchars($hall['location']); ?></td>
                    <td><?= htmlspecialchars($hall['status']); ?></td>
                    <td class="actions">
                        <a href="edit_hall.php?id=<?= $hall['id']; ?>">Edit</a>
                        <a href="delete_hall.php?id=<?= $hall['id']; ?>">Delete</a>
                        <a href="assign_hall.php?id=<?= $hall['id']; ?>">Assign</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}

function displayHalls($result) {
    ?>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* View Halls Page Styles */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            font-weight: bold;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            margin: 0 10px;
            text-decoration: none;
            color: #337ab7;
        }

        .actions a:hover {
            color: #23527c;
        }

        .reserve-button, .book-button {
            padding: 5px 10px;
            color: white;
            background-color: #28a745; /* Green */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 5px;
        }

        .reserve-button:hover, .book-button:hover {
            background-color: #218838; /* Darker Green */
        }
    </style>
    <div class="container">
        <h1>Available Halls</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($hall = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($hall['id']); ?></td>
                    <td><?= htmlspecialchars($hall['name']); ?></td>
                    <td><?= htmlspecialchars($hall['capacity']); ?></td>
                    <td><?= htmlspecialchars($hall['location']); ?></td>
                    <td><?= htmlspecialchars($hall['status']); ?></td>
                    <td class="actions">
                        <a href="reserve_hall.php?id=<?= $hall['id']; ?>" class="reserve-button">Reserve Now</a>
                        <a href="book_hall.php?id=<?= $hall['id']; ?>" class="book-button">Book Now</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}


