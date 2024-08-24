<?php
session_start();

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
  $username = $_SESSION['username'];

  // retrieve users from database
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);

  ?>
  <h1>View Users</h1>
  <table>
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['role']; ?></td>
    </tr>
    <?php } ?>
  </table>

  <?php
} else {
  header('Location: dashboard.php');
  exit;
}
?><?php
session_start();

// Database connection
include 'db.php';

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
    $username = $_SESSION['username'];

    // Retrieve users from database
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <h1>View Users</h1>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #337ab7; color: white;">
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Username</th>
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Email</th>
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: left;">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr style="background-color: <?php echo ($row['role'] === 'Admin') ? '#f2f2f2' : '#fff'; ?>;">
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($row['username']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($row['role']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "Error retrieving users: " . mysqli_error($conn);
    }

    mysqli_free_result($result);
} else {
    header('Location: dashboard.php');
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
