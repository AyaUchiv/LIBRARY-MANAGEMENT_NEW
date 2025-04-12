<?php
// assisted with (https://pccodelitehub.wordpress.com/2025/03/13/lesson-29-building-a-crud-system-create-read-update-delete-with-php-mysql/)


//CODE TO UPDATE BOOK DATA
require_once "connect.php";

$book_id = $_GET["bookId"];

// Fetch book details using a prepared statement
$stmt = $conn->prepare("SELECT * FROM book WHERE bookId = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $book_edition = $_POST['book_edition'];
    $book_status = $_POST['book_status'];
    $book_quantity = $_POST['book_quantity'];
    $book_genre = $_POST['book_genre'];

    //automatically edit the quantity available when book info is updated
    $borrowed_books = $book['quantity'] - $book['quantity_available'];
    $new_quantity_available = $book_quantity - $borrowed_books;

    $sql = "UPDATE book SET name = ?, author = ?, edition = ?, status = ?, quantity = ?, quantity_available = ?, genre = ? WHERE bookId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiisi", $book_title, $book_author, $book_edition, $book_status, $book_quantity, $new_quantity_available, $book_genre, $book_id);


    if ($stmt->execute()) {
        header("Location: ../HTML/admin_books_management.php");
    } else {
        echo "Error:" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h3>Update Books</h3>

    <!-- FORM UPDATE -->
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="book_title" class="form-label">Book Title:</label>
            <input type="text" name="book_title" value="<?php echo $book['name']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="book_author" class="form-label">Book Author:</label>
            <input type="text" name="book_author" value="<?php echo $book['author']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="book_edition" class="form-label">Book Edition:</label>
            <input type="text" name="book_edition" value="<?php echo $book['edition']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="book_status" class="form-label">Book Status:</label>
            <select name="book_status" class="form-control" required>
                <option value="" disabled>Choose Status</option>
                <option value="available" <?php if ($book['status'] == "available") echo "selected"; ?>>Available</option>
                <option value="unavailable" <?php if ($book['status'] == "unavailable") echo "selected"; ?>>Unavailable</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="book_quantity" class="form-label">Book Quantity:</label>
            <select name="book_quantity" class="form-control" required>
                <option value="" disabled>Choose Quantity</option>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($book['quantity'] == $i) ? "selected" : "";
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="book_genre" class="form-label">Book Genre:</label>
            <select name="book_genre" class="form-control" required>
                <option value="" disabled>Choose Genre</option>
                <option value="fiction" <?php if ($book['genre'] == "fiction") echo "selected"; ?>>Fiction</option>
                <option value="nonfiction" <?php if ($book['genre'] == "nonfiction") echo "selected"; ?>>Non Fiction</option>
                <option value="education" <?php if ($book['genre'] == "education") echo "selected"; ?>>Education</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary" onclick="return confirmUpdate()">Update Books</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        // JavaScript confirmation for uploading book
        function confirmUpdate() {
            var confirmation = confirm("Are you sure you want to update this book?");
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>