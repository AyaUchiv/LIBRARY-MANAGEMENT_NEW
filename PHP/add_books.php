<?php
require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get arrays of book data from the form submission
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $book_edition = $_POST['book_edition'];
    $book_quantity = $_POST['book_quantity'];
    $book_genre = $_POST['book_genre'];


    // Loop through each book
    for ($i = 0; $i < count($book_title); $i++) {
        $current_book_title = $book_title[$i];
        $current_book_author = $book_author[$i];
        $current_book_edition = $book_edition[$i];
        $current_book_quantity = $book_quantity[$i];
        $current_book_genre = $book_genre[$i];

        //database check for book
        $stmt = $conn->prepare("SELECT bookId FROM book WHERE name = ? AND author = ? AND edition = ?");
        $stmt->bind_param("sss", $current_book_title, $current_book_author, $current_book_edition);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script type='text/javascript'>alert('This book has already been uploaded!');</script>";
        } else {

            //automatically edit the quantity available when book info is updated
            $quantity_available = $current_book_quantity;

            $sql = $conn->prepare("INSERT INTO book (name, author, edition, quantity, genre, quantity_available)
                VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $current_book_title, $current_book_author, $current_book_edition, $current_book_quantity, $current_book_genre, $quantity_available);
            if ($sql->execute() === TRUE) {
                echo "<script type='text/javascript'>alert('Uploaded successfully!');</script>";
            } else {
                echo "Error: " . $sql->error . "<br>" . $conn->error;
            }
            $sql->close();
        }
        $stmt->close();
    }

    echo "<script type='text/javascript'>window.location.href = '../HTML/admin_books_management.php';</script>";
}
