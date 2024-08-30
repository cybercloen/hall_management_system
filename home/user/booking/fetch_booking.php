// Include database connection
require_once 'db.php';

$query = "SELECT booking_date FROM bookings WHERE hall_id = ?"; // Use prepared statements in production
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $hall_id); // Assuming $hall_id is obtained from user input
$stmt->execute();
$result = $stmt->get_result();

$booked_dates = [];
while ($row = $result->fetch_assoc()) {
    $booked_dates[] = $row['booking_date'];
}

$stmt->close();
