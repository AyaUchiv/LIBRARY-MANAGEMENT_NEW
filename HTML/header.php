<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Default values
$logged_in = false;
$isAdmin = false;

// Set values if session exists
if (isset($_SESSION['user_name'])) {
  $logged_in = !empty($_SESSION['user_name']);
  $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1;
}
?>


<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/aya_style.css">
  <script src="assets/css/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale">
</head>


<body>
  <header class="body_header">

    <!--INSERT NAVIGATION BAR-->
    <nav class="navbar">
      <div class="container-fluid">
        <h5 class="mb-3"><a href="index_page.php" class="navbar-brand fw-bold text-pink fs-5">LIBRARY MANAGEMENT</a></h5>
        <a href="view_all_books.php">View All</a>

        <?php if ($logged_in): ?>
          <a href="user_dashboard.php">Profile</a>

          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
              data-bs-toggle="dropdown" aria-expanded="false">
              Manage Profile:
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="profile.php">Edit Profile</a></li>
              <li><a class="dropdown-item" href="books_management.php">Books</a></li>
            </ul>
          </div>

          <?php if ($isAdmin): ?>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                Manage Books:
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="admin_books_management.php">All Books</a></li>
                <li><a class="dropdown-item" href="admin_books_reserved.php">Reserved Books</a>
                </li>
              </ul>
            </div>

            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                Manage Users:
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="admin_users_profile.php">All Users</a></li>
                <li><a class="dropdown-item" href="admin_message.php">Admin Notification</a></li>
                <li><a class="dropdown-item" href="admin_owing_user.php">Owing Users</a></li>
              </ul>
            </div>
          <?php endif; ?>

          <a onclick="return confirmLogout()" href="../PHP/logout.php">Sign Out</a>
        <?php else: ?>
          <a href="login_form.php">Sign In</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <script type="text/javascript">
  function confirmLogout() {
    return confirm("Are you sure you want to log out?");
  }
</script>
