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
    $book_quantity = $_POST['book_quantity'];
    $book_genre = $_POST['book_genre'];


    // Check if the book exists (title + author + edition)
    $stmt = $conn->prepare("SELECT bookId, quantity, quantity_available FROM book WHERE name = ? AND author = ? AND edition = ?");
    $stmt->bind_param("sss", $book_title, $book_author, $book_edition);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $book_id = $book['bookId'];

        // If the quantity is the same, show alert
        if ($book['quantity'] == $book_quantity) {
            echo "<script>alert('This book has already been uploaded!'); window.location.href = '../HTML/admin_books_management.php';</script>";
            exit;
        }

        // Calculate new quantity_available
        $borrowed_books = $book['quantity'] - $book['quantity_available'];
        $new_quantity_available = $book_quantity - $borrowed_books;

        if ($new_quantity_available < 0) {
            echo "<script>alert('Error: New quantity is less than borrowed books!'); window.location.href = '../HTML/admin_books_management.php';</script>";
            exit;
        }

        // Before updating, check if another book already has the same title + author + edition
        $check_duplicate = $conn->prepare("SELECT bookId FROM book WHERE name = ? AND author = ? AND edition = ? AND bookId != ?");
        $check_duplicate->bind_param("sssi", $book_title, $book_author, $book_edition, $book_id);
        $check_duplicate->execute();
        $dup_result = $check_duplicate->get_result();

        if ($dup_result->num_rows > 0) {
            echo "<script>alert('Error: Another book with the same title, author, and edition already exists!'); window.location.href = '../HTML/admin_books_management.php';</script>";
            exit;
        }

        // Proceed with the update
        $update = $conn->prepare("UPDATE book SET name = ?, author = ?, edition = ?, quantity = ?, quantity_available = ?, genre = ? WHERE bookId = ?");
        $update->bind_param("sssiisi", $book_title, $book_author, $book_edition, $book_quantity, $new_quantity_available, $book_genre, $book_id);

        if ($update->execute()) {
            echo "<script>alert('Book updated successfully!'); window.location.href = '../HTML/admin_books_management.php';</script>";
            exit;
        } else {
            echo "<script>alert('Update failed: " . addslashes($update->error) . "');</script>";
        }
    } else {
        echo "<script>alert('No existing book found to update.'); window.location.href = '../HTML/admin_books_management.php';</script>";
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
            <input type="text" name="book_title" value="<?php echo $book['name']; ?>" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="book_author" class="form-label">Book Author:</label>
            <input type="text" name="book_author" value="<?php echo $book['author']; ?>" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="book_edition" class="form-label">Book Edition:</label>
            <input type="text" name="book_edition" value="<?php echo $book['edition']; ?>" class="form-control" readonly>
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
                <option value="Fiction" <?php if ($book['genre'] == "Fiction") echo "selected"; ?>>Fiction</option>
                <option value="Non-Fiction" <?php if ($book['genre'] == "Non-Fiction") echo "selected"; ?>>Non-Fiction</option>
                <option value="Education" <?php if ($book['genre'] == "Education") echo "selected"; ?>>Education</option>
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