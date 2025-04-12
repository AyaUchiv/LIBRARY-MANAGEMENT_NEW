<?php
include "connect.php";


$book_id = $_GET["bookId"];
$conn->query("DELETE FROM book WHERE bookId = $book_id");

header("Location: ../HTML/admin_books_management.php");
exit();
?>
