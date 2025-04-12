<?php
// assisted with (https://pccodelitehub.wordpress.com/2025/03/13/lesson-29-building-a-crud-system-create-read-update-delete-with-php-mysql/)

//CODE TO UPDATE BOOK DATA
require_once "connect.php";
require_once "session.php";

$book_id = $_GET["bookId"];


$deleteReservation = $conn->prepare("DELETE FROM book_request WHERE bookId = ? AND email = ?");
$deleteReservation->bind_param("ss", $book_id, $user_email);
if ($deleteReservation->execute()) {

    // Increase available_copies by 1
    $updateBook = $conn->prepare("UPDATE book SET quantity_available = quantity_available + 1 WHERE bookId = ?");
    $updateBook->bind_param("s", $book_id);
    $updateBook->execute();

    // Commit transaction
    $conn->commit();

    echo "<script type='text/javascript'>alert('Book has been successfully returned!');</script>";
    echo "<script type='text/javascript'>window.location.href = '../HTML/user_dashboard.php';</script>";
    exit;
} else {
    // If the query fails, display an error message
    echo "<script type='text/javascript'>alert('There was an error processing your return request.');</script>";
}

$CheckReservation->close();
$deleteReservation->close();
$updateBook->close();
$conn->close();
?>