<?php
require_once "header.php";
require_once "../PHP/connect.php";
require_once "../PHP/session.php";

// Fetch current user data (Replace 'user_email_from_session' with actual session variable)
$user_email = $_SESSION['user_email'];
$sql_fetch = "SELECT Name, Email FROM user WHERE Email = ?";
$stmt = $conn->prepare($sql_fetch);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $new_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Hash the password before storing it
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $sql_update = "UPDATE user SET Name = ?, Email = ?, Password = ? WHERE Email = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssss", $user_name, $new_email, $hashed_password, $user_email);

    if ($stmt->execute()) {
        // Update session variables after a successful update
        $_SESSION['user_email'] = $new_email;
        $_SESSION['user_name'] = $user_name;

        // Redirect to the dashboard
        header("Location: http://library.local/html/user_dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<title>Update Information</title>

<body>
    <h3>Update Info</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="user_name" class="form-label">Full Name:</label>
            <input type="text" name="user_name" value="<?php echo htmlspecialchars($user_data['Name']); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="user_email" class="form-label">Email:</label>
            <input type="email" name="user_email" value="<?php echo htmlspecialchars($user_data['Email']); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="user_password" class="form-label">New Password:</label>
            <input type="password" name="user_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Information</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>