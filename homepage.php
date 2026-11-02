<?php
session_start(); // 1. Bắt đầu phiên làm việc Session

// 2. Kiểm tra nếu chưa đăng nhập (Session 'user' chưa tồn tại) thì bắt buộc quay về trang login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <h3 class="w3-wide"><b>
	<?php
	// 3. Đọc dữ liệu từ Session thay vì Cookie
	echo 'Chao ban '.$_SESSION['fullname'];
    
    // Nút đăng xuất chuyển tới file thoat.php
    echo '<br><a href="thoat.php" class="w3-button w3-red w3-margin-top w3-small" style="text-decoration:none;">Đăng xuất</a>';
	
	// Kết nối CSDL lấy đường dẫn ảnh dựa theo $_SESSION['id']
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "qlbanhang";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if (!$conn->connect_error) {
		$sql = "select img_profile from customers where id = '".$_SESSION['id']."'";
		$result = $conn->query($sql);
		if ($result && $result->num_rows > 0) {
		  $row = $result->fetch_assoc();
		  if(!empty($row['img_profile'])){
			  echo '<br><img src="./uploads/'.$row['img_profile'].'" alt="Anh profile" style="width:100%; max-width:150px; border-radius:50%; margin-top:10px;">';
		  }
		}
	}
    $conn->close();
	?>
	</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a href="#" class="w3-bar-item w3-button">Shirts</a>
    <a href="#" class="w3-bar-item w3-button">Dresses</a>
    <a href="#" class="w3-bar-item w3-button">Jackets</a>
  </div>
</nav>

<!-- Page Content -->
<div class="w3-main" style="margin-left:250px">
  <div class="w3-container w3-padding-32">
    <h1>Trang chủ hệ thống (Sử dụng Session)</h1>
    <p>Chào mừng bạn đã đăng nhập thành công!</p>
  </div>
</div>
</body>
</html>