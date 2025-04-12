<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_management";

//create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//check the connection
if (!$conn) {
    die("Connection failed:".mysqli_connect_error());
}
echo "Connection successfully";
?>