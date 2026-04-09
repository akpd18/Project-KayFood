<?php
session_start();

// Xóa sạch các biến session
$_SESSION = array();

// Hủy bỏ session
session_destroy();

// Chuyển hướng về trang login
header("Location: login.php");
exit();
?>