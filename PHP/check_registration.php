<?php
require_once "connect.php";

//when i submit my form
if (isset($_POST["submit"])) {
    $fullname = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    $password_hidden = password_hash($password, PASSWORD_DEFAULT);

    $error_message = array();

    if (empty($fullname) or empty($email) or empty($password) or empty($repeat_password)) {
        array_push($error_message, "All fields must be filled!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error_message, "Email is not valid.");
    }
    if (strlen($password) < 8) {
        array_push($error_message, "Password must not be less than 8 characters");
    }
    if ($password <> $repeat_password) {
        array_push($error_message, "Password is not identical");
    }
    if (count($error_message) > 0) {
        $errors_combined = implode("\\n", $error_message);
        echo "<script>alert('$errors_combined'); window.history.back();</script>";
    } else {

        //database check for email
        $stmt = $conn->prepare("SELECT Email FROM user WHERE Email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error); //Show actual error
            echo "<script type='text/javascript'>window.location.href = '../HTML/signup_form.php';</script>";
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script type='text/javascript'>alert('This user is already registered!');</script>";
            echo "<script type='text/javascript'>window.location.href = '../HTML/signup_form.php';</script>";
            $stmt->close();
        } else {
            $sql = $conn->prepare("INSERT INTO user (Name, Email, Password)
                VALUES (?, ?, ?)");
            $sql->bind_param("sss", $fullname, $email, $password_hidden);
            if ($sql->execute() === TRUE) {
                echo "<script type='text/javascript'>alert('Registration Successful!');</script>";
                echo "<script type='text/javascript'>window.location.href = '../HTML/login_form.php';</script>";
            } else {
                echo "Error: " . $sql->error . "<br>" . $conn->error;
            }
            $sql->close();
            exit;
        }
    }
}
?>