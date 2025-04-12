<?php
require_once "connect.php";

/*connecting to books table in sql database called LIBRARY
$select_books = "SELECT * FROM `book` ORDER BY `book`.`name` ASC;";
$result = mysqli_query($conn, $select_books);*/

// Get the search query if it's set
$search_query = isset($_POST['search_text']) ? $_POST['search_text'] : '';

// Build the SQL query to fetch books
$select_books = "SELECT * FROM `book` WHERE `name` LIKE ? ORDER BY `name` ASC";
$stmt = $conn->prepare($select_books);
$search_param = "%" . $search_query . "%"; // Add wildcards for LIKE search
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
while ($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $sn . "</td>";
echo "<td>" . htmlspecialchars($row['name']) . "</td>";
echo "<td>" . htmlspecialchars($row['author']) . "</td>";
echo "<td>" . htmlspecialchars($row['edition']) . "</td>";
echo "<td>" . htmlspecialchars($row['status']) . "</td>";
echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
echo "<td>" . htmlspecialchars($row['quantity_available']) . "</td>";
echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
echo "<td>
    <a href='../PHP/update_book.php?bookId=" . $row['bookId'] . "'>Update</a> / 
    <a href='#' onclick='confirmDelete(" . $row['bookId'] . ")'>Delete</a>
</td>";
echo "</tr>";
$sn++;
}
echo "</table>";

//JAVASCRIPT FOR POP UP MESSAGE
?>

<script type="text/javascript">
    
    function confirmDelete(bookId) {
        var confirmation = confirm("Are you sure you want to delete this book?");

        if (confirmation) {
            window.location.href = "../PHP/delete_book.php?bookId=" + bookId;
        } else {
            return false;
        }
    }
</script>