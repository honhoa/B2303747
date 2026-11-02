<?php
session_start();

// 1. Xóa tất cả các biến lưu trong Session
session_unset();

// 2. Hủy bỏ phiên làm việc Session hiện tại
session_destroy();

// 3. Đặt thời gian quá hạn để xóa sạch Cookie cũ (nếu có)
setcookie("user", "", time() - 3600, "/");
setcookie("fullname", "", time() - 3600, "/");
setcookie("id", "", time() - 3600, "/");

// 4. Thông báo và tự động chuyển hướng về trang đăng nhập login.php
echo "Ban da dang xuat thanh cong khoi he thong!<br>";
echo "Dang chuyen ve trang dang nhap...";
header('Refresh: 2;url=login.php');
?>