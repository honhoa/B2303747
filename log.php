<?php
session_start(); // 1. Bắt buộc phải có session_start() ở đầu file để dùng Session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Tạo kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Truy vấn kiểm tra email và password (md5)
$sql = "select id, fullname, email from customers where email = '".$_POST["email"]."' and password = '".md5($_POST["pass"])."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  
  // 2. Thay vì dùng setcookie(), ta gán dữ liệu vào biến siêu toàn cục $_SESSION
  $_SESSION['user'] = $row['email'];
  $_SESSION['fullname'] = $row['fullname'];
  $_SESSION['id'] = $row['id'];
  
  // Chuyển hướng sang trang chủ
  header('Location: homepage.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  // Trở về trang đăng nhập sau 3 giây
  header('Refresh: 3;url=login.php');
}
$conn->close();
?>