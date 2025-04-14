<?php
//assisted with AI
require_once "connect.php";
require_once "session.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// setting the penalty
$max_penalty = 100;
$base_rate = 5/7;     // First 7 days
$extra_rate = 2/7;    // After 7 days
try {
// Fetch overdue all books overdue
$owing_users = $conn->prepare("
    SELECT br.*, u.Name AS user_name, b.Name AS book_title, DATEDIFF(CURDATE(), return_date) AS days_late
    FROM book_request br
    JOIN user u ON u.Email = br.email
    JOIN book b ON b.bookId = br.bookId
    WHERE br.return_date < CURDATE()
");
$owing_users->execute();
$result = $owing_users->get_result();


while ($row = $result->fetch_assoc()) {
    $request_id = $row['request_id'];
    $days_late  = (int)$row['days_late']; // the calculation in the SQL query for the difference between the current date and the return date
    $name       = $row['user_name'];
    $book_title = $row['book_title'];
    $email      = $row['email'];

    // Calculate penalty based on the days late
    if ($days_late <= 7) {
        $penalty_amount = $days_late * $base_rate; // Base rate for the first 7 days
    } else {
        $penalty_amount = (7 * $base_rate) + (($days_late - 7) * $extra_rate); // Extra rate after 7 days
    }

    // Make sure the penalty does not exceed the max penalty
    $penalty_amount = min($penalty_amount, $max_penalty);

    // Update book_request penalty
    $updatePenalty = $conn->prepare("UPDATE book_request SET book_penalty = ? WHERE request_id = ?");
    $updatePenalty->bind_param("ii", $penalty_amount, $request_id);
    $updatePenalty->execute();

    // Sync with owing_users table
    $checkOwing = $conn->prepare("SELECT book_penalty FROM owing_users WHERE email = ? AND book_title = ?");
    $checkOwing->bind_param("ss", $email, $book_title);
    $checkOwing->execute();
    $owingResult = $checkOwing->get_result();

    if ($owingResult->num_rows > 0) {
        // Update existing penalty 

        $updateOwing = $conn->prepare("UPDATE owing_users SET book_penalty = ? WHERE email = ? AND book_title = ?");
        $updateOwing->bind_param("iss", $penalty_amount, $email, $book_title);
        $updateOwing->execute();
    } else {
        // Insert new owing user
        $insertOwing = $conn->prepare("INSERT INTO owing_users (email, name, book_title, book_penalty) VALUES (?, ?, ?, ?)");
        $insertOwing->bind_param("sssi", $email, $name, $book_title, $penalty_amount);
        $insertOwing->execute();
    }
}

// Redirect user or admin
exit;
}
catch (mysqli_sql_exception $e) {
    echo "MySQL Error: " . $e->getMessage();
    exit;
}
?>