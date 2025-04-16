<?php
// assisted with (https://pccodelitehub.wordpress.com/2025/03/13/lesson-29-building-a-crud-system-create-read-update-delete-with-php-mysql/)


require_once "connect.php";
require_once "session.php";

$book_id = $_GET["bookId"];

// Check if user has already reserved up to 3 books
$CheckReservationFull = $conn->prepare("SELECT * FROM book_request WHERE UserID = ?");
$CheckReservationFull->bind_param("i", $user_id);
$CheckReservationFull->execute();
$CheckReservationFull->store_result();

if ($CheckReservationFull->num_rows >= 3) {
    echo "<script>
        alert('You have reached the maximum number of books you can borrow.\\nReturn a book to borrow another!');
        window.location.href = '../HTML/view_all_books.php';
    </script>";
    $CheckReservationFull->close();
    exit;
}
$CheckReservationFull->close();

// Check if user has already reserved this specific book
$CheckReservation = $conn->prepare("SELECT * FROM book_request WHERE bookId = ? AND UserID = ?");
$CheckReservation->bind_param("si", $book_id, $user_id);
$CheckReservation->execute();
$CheckReservation->store_result();

if ($CheckReservation->num_rows > 0) {
    echo "<script>
        alert('You have already reserved this book!');
        window.location.href = '../HTML/view_all_books.php';
    </script>";
    $CheckReservation->close();
    exit;
}
$CheckReservation->close();

// Reserve the book
$sql = $conn->prepare("INSERT INTO book_request (bookId, UserID, issue_date,return_date) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY))");
$sql->bind_param("ii", $book_id, $user_id);

if ($sql->execute()) {
    // Reduce quantity_available
    $updateBook = $conn->prepare("UPDATE book SET quantity_available = quantity_available - 1 WHERE bookId = ?");
    $updateBook->bind_param("s", $book_id);
    $updateBook->execute();
    $updateBook->close();

    echo "<script>
        alert('Book has successfully been reserved. Come for pickup with your Id!');
        window.location.href = '../HTML/view_all_books.php';
    </script>";
    $sql->close();
    $conn->close();
    exit;
} else {
    echo "There was an error processing your request.";
    $sql->close();
    $conn->close();
}
?>