<?php
//begin the session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//check if the user is logged in if not redirect to login page
if (!isset($_SESSION['user_name'])) {
  echo "<script type='text/javascript'>alert('Please login to perform any action.');</script>";
  echo "<script type='text/javascript'>window.location.href = '../HTML/login_form.php';</script>";
  exit();
}
//if logged in, obtain the fullname and avoid error message if value not set
$user_email = $_SESSION['user_email'] ?? '';
$full_name = $_SESSION['user_name'] ?? '';
$isAdmin = $_SESSION['isAdmin'] ?? 0;
$user_id = $_SESSION['UserID'] ?? '';
?>