<?php
require_once 'db.php';

// Retrieve all halls from the database
$sql = "SELECT * FROM halls";
$result = mysqli_query($conn, $sql);

// Assuming $hall is the array you're working with
// $status = isset($hall['status']) ? $hall['status'] : 'N/A'; // Default to 'N/A' if 'status' doesn't exist


// Check if there are any halls
if (mysqli_num_rows($result) > 0) {
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4ff; /* Light background */
        }
        
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the container */
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            margin-top: 0;
            font-weight: bold;
            color: #007BFF; /* Primary blue color */
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
            background-color: #e7f1ff; /* Light blue background for headers */
            color: #007BFF; /* Blue text for headers */
        }
        
        .actions {
            text-align: center;
        }
        
        .actions a {
            margin: 0 10px;
            text-decoration: none;
            color: #007BFF; /* Blue color for action links */
        }
        
        .actions a:hover {
            color: #0056b3; /* Darker blue on hover */
        }
        
        .hall-image {
            width: 100px; /* Adjust the size as needed */
            height: auto;
            border-radius: 4px;
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
                <th>Images</th>
                <th>Actions</th>
            </tr>
            <?php while ($hall = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($hall['id']); ?></td>
                <td><?= htmlspecialchars($hall['name']); ?></td>
                <td><?= htmlspecialchars($hall['capacity']); ?></td>
                <td><?= htmlspecialchars($hall['location']); ?></td>
                <td><?= htmlspecialchars($hall['status']); ?></td>
                <td>
                    <img src="<?= htmlspecialchars($hall['interior_image_url']); ?>" alt="Interior Image" class="hall-image">
                    <img src="<?= htmlspecialchars($hall['exterior_image_url']); ?>" alt="Exterior Image" class="hall-image">
                </td>
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
} else {
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4ff; /* Light background */
        }
        
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the container */
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        p {
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #666;
        }
    </style>
    <div class="container">
        <p>No halls found.</p>
    </div>
    <?php
}
mysqli_close($conn);
?>
