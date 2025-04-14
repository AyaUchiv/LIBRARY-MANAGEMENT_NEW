<?php
require_once "connect.php";
session_start();

//check to see if a form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //obtain the username and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'admin') {
        $role = 1;
    }
    else {
        $role = 0;
    }
    //create a sql command to retreive the data
    $sql = "SELECT Email,Name,Password,IsAdmin FROM user WHERE Email = ? AND IsAdmin = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $email, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //check if any data was obtained
    if (mysqli_num_rows($result) > 0) {

        //a username matches
        $row = mysqli_fetch_assoc($result);

        //check if password is also correct
        if (password_verify($password, $row["Password"])) {

            //set session variables
            $_SESSION['user_name'] = $row['Name'];
            $_SESSION['user_email'] = $row['Email'];
            $_SESSION['isAdmin'] = $row['IsAdmin'];

            // Check admin status and redirect
            if ($row['IsAdmin'] == 1) {
                echo "<script>
        alert('Login Successful! Welcome Admin');
        window.location.href = '../HTML/user_dashboard.php';
    </script>";
            } else {
                echo "<script>
        alert('Login Successful!');
        window.location.href = '../HTML/user_dashboard.php';
    </script>";
            }
        } else {
            //password did not match
            echo "<script type='text/javascript'>alert('Invalid credentials!');</script>";
            echo "<script type='text/javascript'>window.location.href = '../HTML/login_form.php';</script>";
        }
    } else {
        //username did not match
        echo "<script type='text/javascript'>alert('Invalid credentials!');</script>";
        echo "<script type='text/javascript'>window.location.href = '../HTML/login_form.php';</script>";
    }

    //close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>