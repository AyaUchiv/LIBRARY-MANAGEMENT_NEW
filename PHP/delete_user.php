<?php
include "connect.php";
session_start();

$email = $_GET["Email"] ?? '';
$user_ID = $_GET["UserID"] ?? '';
$currentUserEmail = $_SESSION['user_email'] ?? '';

// Validate email format just for display purposes
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Prevent deleting yourself
if ($email === $currentUserEmail) {
    echo "<script>alert('You cannot delete yourself.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Check if user has borrowed books
$checkBorrowedBooks = $conn->prepare("SELECT 1 FROM book_request WHERE UserID = ?");
$checkBorrowedBooks->bind_param("i", $user_ID);
$checkBorrowedBooks->execute();
$result = $checkBorrowedBooks->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('$email has borrowed a book and cannot be deleted.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
} else {
    $stmt = $conn->prepare("DELETE FROM user WHERE UserID = ?");
    $stmt->bind_param("i", $user_ID);

    if ($stmt->execute()) {
        echo "<script>alert('$email has been deleted.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: {$conn->error}'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    }
}

$stmt->close();
$conn->close();
exit();

?>