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
    $new_name = $_POST['user_name1'];
    $new_email = $_POST['user_email1'];
    $user_password = $_POST['user_password1'];

    // Check if the new email is already in use by another user
    if ($new_email !== $user_email) {
        $check_email = $conn->prepare("SELECT Email FROM user WHERE Email = ?");
        $check_email->bind_param("s", $new_email);
        $check_email->execute();
        $check_email_result = $check_email->get_result();

        if ($check_email_result->num_rows > 0) {
            echo "<script type='text/javascript'>alert('Email already in use!');</script>";
            echo "<script type='text/javascript'>window.location.href = 'profile.php';</script>";
            exit;
        }
    }

    // Build the update query (with or without password)
    if (!empty($user_password)) {
        if (strlen($user_password) > 8) {
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE user SET Name = ?, Email = ?, Password = ? WHERE Email = ?";
            $update_profile = $conn->prepare($sql_update);
            $update_profile->bind_param("ssss", $new_name, $new_email, $hashed_password, $user_email);
        } else {
            echo "<script type='text/javascript'>alert('Password has to be more than 8 characters!');</script>";
            echo "<script type='text/javascript'>window.location.href = 'profile.php';</script>";
            exit(); 
        }
    } else {
        $sql_update = "UPDATE user SET Name = ?, Email = ? WHERE Email = ?";
        $update_profile = $conn->prepare($sql_update);
        $update_profile->bind_param("sss", $new_name, $new_email, $user_email);
    }

    // Execute the update
    if ($update_profile->execute()) {
        $_SESSION['user_email'] = $new_email;
        $_SESSION['user_name'] = $new_name;

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
                    <label for="user_name1" class="form-label">Full Name:</label>
                    <input type="text" name="user_name1" id="user_name1" value="<?php echo htmlspecialchars($full_name); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="user_email1" class="form-label">Email:</label>
                    <input type="email" name="user_email1" id="user_email1" value="<?php echo htmlspecialchars($user_email); ?>" class="form-control" required>
                </div>

                <div class="mb-3 position-relative">
                    <label for="user_password1" class="form-label">New Password:</label>
                    <input type="password" name="user_password1" id="user_password1" class="form-control pe-5">

                    <i class="bi bi-eye-slash position-absolute end-0" id="togglePassword1"
                        style="top: 50%; transform: translateY(-0%); cursor: pointer; right: 5rem; font-size: 1.2rem;"></i>

                </div>

                <button type="submit" name="submit" class="btn btn-pink">Update Information</button>
            </form>
        </div>
    </div>

</body>

</html>