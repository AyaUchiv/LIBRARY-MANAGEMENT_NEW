<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aya_style.css">
    <script src="assets/javascript/script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="form-container text-center">

            <h5 class="mb-3"><a href="index_page.php" class="navbar-brand fw-bold text-pink fs-5">LIBRARY MANAGEMENT</a></h5>
            <h5 class="text-center">Sign In</h5>

            <form id="cvform" action="../PHP/check_login.php" method="POST">

                <div class="mb-3">
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" placeholder="Email" class="form-control" maxlength="50" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required=""><br>
                </div>

                <div class="mb-3 position-relative">
                    <label for="user_password1" class="form-label">Password:</label><br>
                    <input type="password" name="password" placeholder="Password" maxlength="50" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>" id="user_password1" class="form-control pe-5" required=""><br>
                    <i class="bi bi-eye-slash position-absolute top-50 translate-middle-y end-0 me-4" id="togglePassword1" style="cursor: pointer; font-size: 1.2rem;"></i>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select id="role" name="role" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-pink">Sign In</button>

            </form>

            
            <p class="mt-3">New User? <a href="signup_form.php">&nbsp Register</a></p>
        </div>
    </div>

</body>

</html>