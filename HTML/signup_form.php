<!DOCTYPE html>
<html>

<head>
<title>Register User</title>
<link rel = "stylesheet" href = "assets/css/bootstrap.css">
<link rel = "stylesheet" href = "assets/css/aya_style.css">
<meta charset = "utf-8">
<meta name = "viewport" content = "width=device-width, initial-scale">
</head>


<body>
 

<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="form-container text-center">

            <h5 class="mb-3"><a href="index_page.php" class="navbar-brand fw-bold text-pink fs-5">LIBRARY MANAGEMENT</a></h5>
            <h5 class="text-center">Register New User</h5>
   
        <form id = "cvform"  action = "../PHP/check_registration.php" method = "POST">
            
        <div class="mb-3">
            <label for = "name">Full Name:</label><br>
            <input type = "text" name = "fullName" placeholder = "Full Name" class = "form-control" maxlength="50" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>" required = ""><br>
        </div>

        <div class="mb-3">
            <label for = "email">Email:</label><br>
            <input type = "email" name = "email" placeholder = "Email" class = "form-control" maxlength="50" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required = ""><br>
        </div>

        <div class="mb-3">
            <label for = "password">Password:</label><br>
            <input type = "password" name = "password" placeholder = "Password" class = "form-control" maxlength="50" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>" required = ""><br>
        </div>

        <div class="mb-3">
            <label for = "repeat_password">Repeat Password:</label><br>
            <input type = "password" name = "repeat_password" placeholder = "Password" class = "form-control" maxlength="50" value="<?php echo htmlspecialchars($_POST['repeat_password'] ?? ''); ?>" required = ""><br>
        </div>

        <button type="submit" name="submit" class="btn btn-pink">Sign Up</button>

</form>

<p class="text-center">Already a User? <a href = "login_form.php">&nbsp Login</a></p>


</body>
</html>