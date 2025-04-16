<?php
require_once "header.php";
require_once "../PHP/connect.php";
require_once "../PHP/session.php";
require_once "../PHP/penalty.php";
?>

<title><?php echo $full_name;?> Dashboard</title>
        <main>
<div class = "splash-container">
    <div class = "message-box">
        <h1>Hi, Welcome Back <?php echo $full_name;?></h1>
        </div>
        </div>
        </main>
            
<?php
require_once "footer.html";
?>


