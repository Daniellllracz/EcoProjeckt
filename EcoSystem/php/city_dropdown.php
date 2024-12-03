<?php
// Include your database connection
include 'db_connection.php'; // Example

// Fetch cities from the database
$result = $conn->query("SELECT * FROM Cities");

echo '<label for="city">City:</label>';
echo '<select id="city" name="city">';
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id'] . "'>" . $row['city_name'] . "</option>";
}
echo '</select>';
?>
