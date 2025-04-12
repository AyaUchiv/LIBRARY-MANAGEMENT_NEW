<?php
require_once "connect.php";
session_start();

//setting the admin session email
$currentUserEmail = $_SESSION['user_email'] ?? '';

$email = $_GET["Email"];
$action = $_GET["action"] ?? '';

// Basic validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

//ensuring the admin cannot demote themselves
if ($action === "demote" && $email === $currentUserEmail) {
    echo "<script>alert('You cannot remove yourself as an admin.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Determine admin status based on action
if ($action === "promote") {
    $admin = 1;
    $message = "{$email} has been made an admin.";
} elseif ($action === "demote") {
    $admin = 0;
    $message = "{$email} has been removed as admin.";
} else {
    echo "<script>alert('Invalid action.'); window.location.href = '../HTML/admin_users_profile.php';</script>";
    exit;
}

// Update admin status
$stmt = $conn->prepare("UPDATE user SET IsAdmin = ? WHERE Email = ?");
$stmt->bind_param("is", $admin, $email);

if ($stmt->execute()) {
    echo "<script>alert('$message'); window.location.href = '../HTML/admin_users_profile.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>