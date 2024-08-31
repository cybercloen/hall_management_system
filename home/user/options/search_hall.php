<?php
include 'db.php';

// Check if query and search_by are set
if (isset($_GET["query"]) && isset($_GET["search_by"])) {
    $query = $_GET["query"];
    $search_by = $_GET["search_by"];

    // Prepare SQL query based on search by field
    $sql = "SELECT * FROM halls WHERE ";

    switch ($search_by) {
        case "name":
            $sql .= "name LIKE ?";
            break;
        case "location":
            $sql .= "location LIKE ?";
            break;
        case "capacity":
            $sql .= "capacity LIKE ?";
            break;
        case "rental_per_day":
            $sql .= "rental_per_day LIKE ?";
            break;
        default:
            $sql = "SELECT * FROM halls"; // Default case to fetch all halls
            break;
    }

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters
        $param = "%" . $query . "%"; // Adding wildcards for LIKE
        mysqli_stmt_bind_param($stmt, "s", $param);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // Display search results
        echo '<style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                }
                h2 {
                    color: #0056b3; /* Blue color for the heading */
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    padding: 10px;
                    border: 1px solid #ddd;
                    text-align: left;
                }
                th {
                    background-color: #0056b3; /* Blue background for header */
                    color: white;
                }
                tr:hover {
                    background-color: #f1f1f1;
                }
              </style>';

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Search Results</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Location</th><th>Capacity</th><th>Rental per day</th></tr>";
            while ($hall = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($hall["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($hall["location"]) . "</td>";
                echo "<td>" . htmlspecialchars($hall["capacity"]) . "</td>";
                echo "<td>" . htmlspecialchars($hall["rental_per_day"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement.";
    }
} else {
    echo "Invalid search parameters.";
}

// Close the database connection
mysqli_close($conn);
?>
