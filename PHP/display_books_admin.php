<?php
require_once "connect.php";

// Get the search query if it's set
$search_query = isset($_POST['search_text']) ? $_POST['search_text'] : '';

// Build the SQL query to fetch books
$select_books = "SELECT * FROM `book` WHERE `name` LIKE ? ORDER BY `name` ASC";
$stmt = $conn->prepare($select_books);
$search_param = "%" . $search_query . "%"; 
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

//show books in table
echo "<table class = 'table table-bordered table-hover' id = 'table_data'>";
//TABLE HEADER
echo "<tr style='background-color:pink;'>";
echo "<th>S/N</th>";
echo "<th>Book Name</th>";
echo "<th>Author Name</th>";
echo "<th>Book Edition</th>";
echo "<th>Book Status</th>";
echo "<th>Book Quantity</th>";
echo "<th>Book Available</th>";
echo "<th>Book Genre</th>";
echo "<th>Book Action</th>";
echo "</tr>";

// Serial number counter
$sn = 1;

//loop through to generate the books in the table.
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $sn . "</td>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
    echo "<td>" . htmlspecialchars($row['edition']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
    echo "<td>" . htmlspecialchars($row['quantity_available']) . "</td>";
    echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
    echo "<td>";
    echo "<a href='../PHP/update_book.php?bookId=" . $row['bookId'] . "'>Update</a> / ";
    echo "<a href='#' onclick='confirmDelete(" . $row['bookId'] . ", \"" . addslashes($row['name']) . "\")'>Delete</a>";
    echo "</td>";
    echo "</tr>";
    $sn++;
}
echo "</table>";

//JAVASCRIPT FOR POP UP MESSAGE
?>

<script>
   function confirmDelete(bookId, bookName) {
    // Show confirmation dialog
    var confirmation = confirm("Are you sure you want to delete the book: " + bookName + "?");

    if (confirmation) {
        // Redirect to the PHP script with the bookId and bookName as query parameters
        window.location.href = "../PHP/delete_book.php?bookId=" + encodeURIComponent(bookId) + "&bookName=" + encodeURIComponent(bookName);

    }
}
</script>