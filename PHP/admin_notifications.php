<?php
require_once "connect.php";


// Get the search query if it's set
$search_query = isset($_POST['search_text']) ? $_POST['search_text'] : '';

// Build the SQL query to fetch books
$admin_messages = "SELECT * FROM `admin_notifications` WHERE notification_message LIKE ?";
$stmt = $conn->prepare($admin_messages);
$search_param = "%" . $search_query . "%"; 
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<tr><td colspan='3'>No notifications found.</td></tr>";
}

//show books in table
echo "<table class = 'table table-bordered table-hover' id = 'table_data'>";
//TABLE HEADER
echo "<tr style='background-color:pink;'>";
echo "<th>S/N</th>";
echo "<th>Notification Message</th>";
echo "<th>Time</th>";
echo "</tr>";

// Serial number counter
$sn = 1;

//loop through to generate the books in the table.
while ($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $sn . "</td>";
echo "<td>" . htmlspecialchars($row['notification_message']) . "</td>";
echo "<td>" . htmlspecialchars($row['notification_time']) . "</td>";
echo "</tr>";
$sn++;
}
echo "</table>";


?>
