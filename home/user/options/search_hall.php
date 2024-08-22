<!-- Search form -->
<form action="search_halls.php" method="get">
  <input type="search" name="query" placeholder="Search for a hall...">
  <select name="search_by">
    <option value="name">Name</option>
    <option value="location">Location</option>
    <option value="capacity">Capacity</option>
    <option value="rental_per_day">Rental per day</option>
  </select>
  <button type="submit">Search</button>
</form>

<!-- search_halls.php -->
<?php
require_once 'db.php';

// Get search query and search by field from URL
$query = $_GET["query"];
$search_by = $_GET["search_by"];

// Construct SQL query based on search by field
switch ($search_by) {
  case "name":
    $sql = "SELECT * FROM halls WHERE name LIKE '%$query%'";
    break;
  case "location":
    $sql = "SELECT * FROM halls WHERE location LIKE '%$query%'";
    break;
  case "capacity":
    $sql = "SELECT * FROM halls WHERE capacity LIKE '%$query%'";
    break;
  case "rental_per_day":
    $sql = "SELECT * FROM halls WHERE rental_per_day LIKE '%$query%'";
    break;
  default:
    $sql = "SELECT * FROM halls";
}

// Execute SQL query
$result = mysqli_query($conn, $sql);

// Display search results
if (mysqli_num_rows($result) > 0) {
  echo "<h2>Search Results</h2>";
  echo "<table>";
  echo "<tr><th>Name</th><th>Location</th><th>Capacity</th><th>Rental per day</th></tr>";
  while ($hall = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $hall["name"] . "</td>";
    echo "<td>" . $hall["location"] . "</td>";
    echo "<td>" . $hall["capacity"] . "</td>";
    echo "<td>" . $hall["rental_per_day"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "<p>No results found.</p>";
}

?>