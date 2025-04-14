<?php
require_once "connect.php";

// Fetch books that have at least one available copy
// Fetch book details using a prepared statement
$stmt = $conn->prepare("SELECT * FROM book WHERE quantity_available > 0 ORDER BY `name` ASC");
$stmt->execute();
$result = $stmt->get_result();


echo "<table class='table table-bordered table-hover' id='table_data'>";

// Table Header
echo "<tr style='background-color:pink;'>";
echo "<th>S/N</th>";
echo "<th>Book Name</th>";
echo "<th>Author Name</th>";
echo "<th>Book Edition</th>";
echo "<th>Book Status</th>";
echo "<th>Book Quantity</th>";
echo "<th>Book Genre</th>";
echo "<th>Book Reservation</th>";
echo "</tr>";

// Serial number counter
$sn = 1;

// Loop through to generate books in the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $sn . "</td>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
    echo "<td>" . htmlspecialchars($row['edition']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['quantity_available']) . "</td>";
    echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
    echo "<td>
        <a href='../PHP/borrow_book.php?bookId=" . urlencode($row['bookId']) . "'>Borrow</a>
    </td>";
    echo "</tr>";
    $sn++;
}
echo "</table>";
?>