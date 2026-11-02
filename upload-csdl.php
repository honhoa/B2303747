<?php
$target_dir = "uploads/";
// Tạo thư mục uploads nếu chưa tồn tại
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Kiểm tra file có phải là hình ảnh thật hay không
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.<br>";
    $uploadOk = 0;
  }
}

// Kiểm tra định dạng file
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
} else {
  // Di chuyển file từ bộ nhớ tạm vào thư mục uploads/
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br>";
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "qlbanhang";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if (!$conn->connect_error && isset($_COOKIE['id'])) {
		$id = $_COOKIE['id'];
		// Cập nhật tên file ảnh vào bảng customers theo id người dùng
		$sql = "UPDATE customers set img_profile = '".$_FILES["fileToUpload"]["name"]."' WHERE id='".$id."'";
		if ($conn->query($sql) === TRUE) {
			echo "Cap nhat csdl thanh cong!<br>";
			echo '<a href="homepage.php">Trang chu</a>';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
  } else {
    echo "Sorry, there was an error uploading your file.<br>";
  }
}
?>