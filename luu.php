<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$date = date_create($_POST["birth"]);
// Mã hóa mật khẩu bằng hàm md5() trước khi chèn vào bảng customers
$sql = "INSERT INTO customers (fullname, email, birthday, password) 
	VALUES ('".$_POST["name"] ."', '".$_POST["email"] ."', '".$date ->format('Y-m-d') ."','".md5($_POST["pass"])."' )";

if ($conn->query($sql) === TRUE) {
  echo "Them sinh vien thanh cong";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>