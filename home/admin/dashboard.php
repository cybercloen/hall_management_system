<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }
        nav li {
            margin-right: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
        }
        nav a:hover {
            color: #ccc;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2em;
        }
        section {
            background-color: #fff;
            padding: 2em;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .actions {
            display: flex;
            justify-content: space-between;
        }
        .actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="add_hall.php">Add Hall</a></li>
                <li><a href="view_hall.php">View Halls</a></li>
                <li><a href="assign_hall.php">Assign Hall</a></li>
                <li><a href="delete_hall.php">Delete Hall</a></li>
                <li><a href="edit_hall.php">Edit Hall</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome Admin</h1>
        <section>
            <h2>Halls</h2>
            <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
                <?php while ($hall = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($hall['id']); ?></td>
                    <td><?= htmlspecialchars($hall['name']); ?></td>
                    <td><?= htmlspecialchars($hall['capacity']); ?></td>
                    <td><?= htmlspecialchars($hall['location']); ?></td>
                    <td class="actions">
                        <a href="edit_hall.php?id=<?= $hall['id']; ?>">Edit</a>
                        <a href="delete_hall.php?id=<?= $hall['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php } else { ?>
            <p>No halls found.</p>
            <?php } ?>
        </section>
    </main>

</body>
</html>
