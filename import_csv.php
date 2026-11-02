<?php
session_start();
$message = "";

// Kiểm tra khi người dùng bấm nút "Import Dữ Liệu"
if (isset($_POST['btn_import'])) {
    // Kiểm tra tập tin đã được chọn và không bị lỗi
    if (isset($_FILES['file_csv']) && $_FILES['file_csv']['error'] == 0) {
        $fileName = $_FILES['file_csv']['name'];
        $fileTmpName = $_FILES['file_csv']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Ràng buộc: Chỉ chấp nhận tập tin có đuôi .csv
        if ($fileExt === 'csv') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qlbanhang";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Mở file CSV tạm thời ở chế độ đọc ("r")
            if (($handle = fopen($fileTmpName, "r")) !== FALSE) {
                $count = 0;
                
                // Đọc từng dòng dữ liệu trong file CSV qua hàm fgetcsv()
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Cấu trúc file CSV giả định: Cột 0: Fullname, Cột 1: Email, Cột 2: Password
                    $fullname = $conn->real_escape_string($data[0]);
                    $email = $conn->real_escape_string($data[1]);
                    $pass = md5($data[2]); // Mã hóa MD5 cho mật khẩu

                    // Thêm dữ liệu vào bảng customers
                    $sql = "INSERT INTO customers (fullname, email, password) VALUES ('$fullname', '$email', '$pass')";
                    if ($conn->query($sql) === TRUE) {
                        $count++;
                    }
                }
                fclose($handle);
                $conn->close();

                $message = "<p style='color:green;'>Import thành công $count dòng dữ liệu từ tập tin CSV vào CSDL!</p>";
            } else {
                $message = "<p style='color:red;'>Không thể mở tập tin CSV!</p>";
            }
        } else {
            $message = "<p style='color:red;'>Lỗi: Vui lòng chọn đúng tập tin có định dạng .CSV!</p>";
        }
    } else {
        $message = "<p style='color:red;'>Vui lòng chọn một tập tin CSV để tải lên!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Import Dữ Liệu Từ File CSV</title>
</head>
<body>
    <h2>IMPORT DỮ LIỆU TỪ FILE CSV VÀO CSDL</h2>
    <?php echo $message; ?>

    <form action="import_csv.php" method="post" enctype="multipart/form-data">
        <label>Chọn tập tin CSV:</label><br><br>
        <input type="file" name="file_csv" accept=".csv" required><br><br>
        <input type="submit" name="btn_import" value="Import Dữ Liệu">
    </form>
    <br>
    <a href="homepage.php">Trở về Trang chủ</a>
</body>
</html>