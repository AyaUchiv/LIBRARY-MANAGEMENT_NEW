<?php
require_once "connect.php";


$stmt = $conn->prepare("SELECT * FROM owing_users");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<tr><td colspan='3'>No user is owing.</td></tr>";
}

//show books in table
echo "<table class = 'table table-bordered table-hover' id = 'table_data'>";
//TABLE HEADER
echo "<tr style='background-color:pink;'>";
echo "<th>S/N</th>";
echo "<th>Book Title</th>";
echo "<th>Email</th>";
echo "<th>Name</th>";
echo "<th>Book Penalty</th>";
echo "</tr>";

// Serial number counter
$sn = 1;

//loop through to generate the books in the table.
while ($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $sn . "</td>";
echo "<td>" . htmlspecialchars($row['book_title']) . "</td>";
echo "<td>" . htmlspecialchars($row['email']) . "</td>";
echo "<td>" . htmlspecialchars($row['name']) . "</td>";
echo "<td>" . htmlspecialchars($row['book_penalty']) . "</td>";
echo "</tr>";
$sn++;
}
echo "</table>";


?>
