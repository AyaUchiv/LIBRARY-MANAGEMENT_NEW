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

    if ($new_email !== $user_email) {
        $check_email = $conn->prepare("SELECT Email FROM user WHERE Email = ?");
        $check_email->bind_param("s", $new_email);
        $check_email->execute();
        $check_email_result = $check_email->get_result();

        if ($check_email_result->num_rows > 0) {
            echo "<script type='text/javascript'>alert('Email already in use!');</script>";
            exit;
        }
    } else {

        // if user does not want to update their password. Hash password before storing
        if (!empty($_POST['user_password'])) {
            $hashed_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

            $sql_update = "UPDATE user SET Name = ?, Email = ?, Password = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssss", $user_name, $new_email, $hashed_password, $user_email);
        } else {
            $sql_update = "UPDATE user SET Name = ?, Email = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("sss", $user_name, $new_email, $user_email);
        }
    }
    if ($stmt->execute()) {
        // Update session variables after a successful update
        $_SESSION['user_email'] = $new_email;
        $_SESSION['user_name'] = $user_name;

        // Redirect to the dashboard
        echo "<script type='text/javascript'>alert('Profile updated!');</script>";
        echo "<script type='text/javascript'>window.location.href = 'user_dashboard.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<title>Update Information</title>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="form-container text-center">

            <h5 class="text-center">Update Info</h5>
            <form id="cvform" method="POST">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Full Name:</label>
                    <input type="text" name="user_name" value="<?php echo htmlspecialchars($user_data['Name']); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="user_email" class="form-label">Email:</label>
                    <input type="email" name="user_email" value="<?php echo htmlspecialchars($user_data['Email']); ?>" class="form-control" required>
                </div>

                <div class="mb-3 position-relative">
                    <label for="user_password" class="form-label">New Password:</label>
                    <input type="password" name="user_password" id="user_password" class="form-control pe-5" required>

                    <i class="bi bi-eye-slash position-absolute end-0" id="togglePassword"
                        style="top: 50%; transform: translateY(-0%); cursor: pointer; right: 5rem; font-size: 1.2rem;"></i>

                </div>

                <button type="submit" name="submit" class="btn btn-pink">Update Information</button>
            </form>
        </div>
    </div>

</body>

</html>