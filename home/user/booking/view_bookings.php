<?php
session_start();

// Include database connection
require_once 'db.php'; // Ensure you include your database connection file

if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  // Prepare SQL statement to prevent SQL injection
  $query = "
    SELECT b.*, h.hall_name 
    FROM bookings b 
    JOIN halls h ON b.hall_id = h.hall_id 
    WHERE b.user_id = ?
  ";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  
  // Get the result
  $result = mysqli_stmt_get_result($stmt);

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
      }

      h1 {
        text-align: center;
        color: #333;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      }

      th, td {
        padding: 12px;
        text-align: left;
      }

      th {
        background-color: #00796b; /* Teal background for header */
        color: white;
        font-weight: bold;
      }

      tr:nth-child(even) {
        background-color: #f9f9f9; /* Light gray for even rows */
      }

      tr:hover {
        background-color: #e0f2f1; /* Light teal on hover */
      }

      tr td {
        border-bottom: 1px solid #ddd; /* Divider between rows */
      }

      /* Responsive design */
      @media (max-width: 600px) {
        table, thead, tbody, th, td, tr {
          display: block;
        }

        th {
          display: none; /* Hide headers on small screens */
        }

        tr {
          margin-bottom: 15px;
          border: 1px solid #ddd; /* Border around each booking */
        }

        td {
          text-align: right;
          position: relative;
          padding-left: 50%; /* Space for labels */
        }

        td::before {
          content: attr(data-label);
          position: absolute;
          left: 10px;
          width: 45%;
          padding-left: 10px;
          font-weight: bold;
          text-align: left;
        }
      }
    </style>
  </head>
  <body>
    <h1>View Bookings for <?php echo htmlspecialchars($username); ?></h1>
    <table>
      <thead>
        <tr>
          <th>Hall Name</th>
          <th>Booking Date</th>
          <th>Booking Time</th>
          <th>Status</th>
          <th>Action</th> <!-- Added Action Column -->
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0) { ?>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td data-label="Hall Name"><?php echo htmlspecialchars($row['hall_name']); ?></td>
            <td data-label="Booking Date"><?php echo htmlspecialchars($row['booking_date']); ?></td>
            <td data-label="Booking Time"><?php echo htmlspecialchars($row['booking_time']); ?></td>
            <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>
            <td data-label="Action">
              <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                <input type="submit" value="Cancel" style="background-color: #d32f2f; color: white; border: none; padding: 5px 10px; cursor: pointer;">
              </form>
            </td>
          </tr>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td colspan="5">No bookings found.</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <?php
    // Free the result set
    mysqli_free_result($result);
    // Close the statement
    mysqli_stmt_close($stmt);
    } else {
      header('Location: login.php');
      exit;
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </body>
  </html>
