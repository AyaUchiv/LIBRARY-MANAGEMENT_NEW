<?php
include "connect.php";

// Get the book details from the query string
if (isset($_GET["bookId"]) && isset($_GET["bookName"])) {
    $book_id = $_GET["bookId"];
    $book_name = $_GET["bookName"];

// Delete book safely
// First, check if the book has been borrowed
$checkBorrowedBooks = $conn->prepare("SELECT * FROM book_request WHERE bookId = ?");
$checkBorrowedBooks->bind_param("i", $book_id);
$checkBorrowedBooks->execute();
$result = $checkBorrowedBooks->get_result();

if ($result->num_rows > 0) {
    // If the book has been borrowed, prevent deletion
    $message = "{$book_name} has been borrowed and cannot be deleted.";
    echo "<script>alert('$message'); window.location.href = '../HTML/admin_books_management.php';</script>";
} 
else {
    // If the book has not been borrowed, proceed to delete
    $deleteBook = $conn->prepare("DELETE FROM book WHERE bookId = ?");
    $deleteBook->bind_param("i", $book_id);
    $deleteBook->execute();

    // Redirect to admin books management page
    $message = "{$book_name} has been be deleted.";
    echo "<script>alert('$message'); window.location.href = '../HTML/admin_books_management.php';</script>";
    exit();  // Ensure script stops after redirect
}
}
else {
    echo "Book ID not provided.";
}
?>
