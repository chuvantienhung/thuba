<?php
// Khởi động phiên làm việc
session_start();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chính
header("Location: login.php");
exit();
?>
