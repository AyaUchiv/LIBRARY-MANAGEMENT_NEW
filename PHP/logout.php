<?php
session_start();
session_destroy();
echo "<script type='text/javascript'>alert('Signed out.');</script>";
echo "<script type='text/javascript'>window.location.href = '../HTML/login_form.php';</script>";
exit();
?>