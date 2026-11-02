<?php
session_start();

// 1. Kiểm tra đăng nhập: Nếu chưa đăng nhập thì đẩy về trang login.php
if (!isset($_SESSION['id'])) {
    echo "Bạn cần đăng nhập trước khi đổi mật khẩu!";
    header('Refresh: 2;url=login.php');
    exit();
}

$thongbao = "";

// 2. Xử lý khi nhấn nút "Đổi mật khẩu"
if (isset($_POST['btn_doimk'])) {
    $mk_cu = $_POST['old_pass'];
    $mk_moi = $_POST['new_pass'];
    $nhaplai_mk_moi = $_POST['re_new_pass'];
    $user_id = $_SESSION['id'];

    // Kiếm tra Điều kiện 1: 2 ô mật khẩu mới phải giống nhau
    if ($mk_moi !== $nhaplai_mk_moi) {
        $thongbao = "<span style='color:red;'>Lỗi: Mật khẩu mới và Nhập lại mật khẩu mới không khớp!</span>";
    } 
    // Kiểm tra Điều kiện 2: Mật khẩu mới không được trùng mật khẩu cũ
    else if ($mk_cu === $mk_moi) {
        $thongbao = "<span style='color:red;'>Lỗi: Mật khẩu mới không được giống với mật khẩu cũ!</span>";
    } 
    else {
        // Kết nối CSDL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "qlbanhang";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Lỗi kết nối: " . $conn->connect_error);
        }

        // Kiểm tra Điều kiện 3: Kiểm tra mật khẩu cũ nhập vào có đúng với CSDL không
        $sql = "SELECT password FROM customers WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // So sánh chuỗi md5 của mật khẩu cũ nhập vào với mật khẩu trong CSDL
            if (md5($mk_cu) !== $row['password']) {
                $thongbao = "<span style='color:red;'>Lỗi: Mật khẩu cũ nhập vào không chính xác!</span>";
            } else {
                // Thỏa mãn tất cả điều kiện -> Băm md5 mật khẩu mới và UPDATE CSDL
                $mk_moi_md5 = md5($mk_moi);
                $sql_update = "UPDATE customers SET password = '$mk_moi_md5' WHERE id = '$user_id'";

                if ($conn->query($sql_update) === TRUE) {
                    $thongbao = "<span style='color:green;'>Đổi mật khẩu thành công!</span>";
                } else {
                    $thongbao = "<span style='color:red;'>Lỗi cập nhật CSDL: " . $conn->error . "</span>";
                }
            }
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
</head>
<body>
    <h2>ĐỔI MẬT KHẨU TÀI KHOẢN</h2>
    <div style="margin-bottom: 15px;"><?php echo $thongbao; ?></div>

    <form action="sua_mk.php" method="post">
        <label>Mật khẩu cũ:</label><br>
        <input type="password" name="old_pass" required><br><br>

        <label>Mật khẩu mới:</label><br>
        <input type="password" name="new_pass" required><br><br>

        <label>Nhập lại mật khẩu mới:</label><br>
        <input type="password" name="re_new_pass" required><br><br>

        <input type="submit" name="btn_doimk" value="Đổi mật khẩu">
    </form>
    <br>
    <a href="homepage.php">Trở về Trang chủ</a>
</body>
</html>