<?php
include "connect.php";
session_start();

$email = $_GET["Email"] ?? '';
$currentUserEmail = $_SESSION['user_email'] ?? '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Prevent deleting yourself
if ($email === $currentUserEmail) {
    echo "<script>alert('You cannot delete yourself.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Delete user safely
// First, check if the user has borrowed any books
$checkBorrowedBooks = $conn->prepare("SELECT * FROM book_request WHERE email = ?");
$checkBorrowedBooks->bind_param("s", $email);
$checkBorrowedBooks->execute();
$result = $checkBorrowedBooks->get_result();

if ($result->num_rows > 0) {
    // If the user has borrowed books, prevent deletion
    $message = "{$email} has borrowed a book and cannot be deleted.";
    echo "<script>alert('$message'); window.location.href = '../HTML/admin_users_profile.php';</script>";
} else {
    // If no books are borrowed, proceed with deletion
    $stmt = $conn->prepare("DELETE FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $message = "{$email} has been deleted.";
        echo "<script>alert('$message'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    } else {
        $message = "Error deleting user: {$conn->error}";
        echo "<script>alert('$message'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    }
}

$stmt->close();
$conn->close();
exit();
?>