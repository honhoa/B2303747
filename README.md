# B2303747
Lương Vĩnh Hơn 2005 
Bước 1: Chuẩn bị môi trường Cài đặt:

1.XAMPP 2.Visual Studio Code 3.Git

Bước 2: Clone dự án

Mở Terminal tại thư mục C:\xampp\htdocs và chạy: git clone https://github.com/nguyenyen2006/QLKinhDoanhOToDien.git 3. Cấu trúc thư mục

QLKinhDoanhOToDien/ ├── admin/ # Chức năng quản trị viên ├── assets/ # CSS, JavaScript, hình ảnh ├── auth/ # Đăng nhập, đăng ký, đăng xuất ├── config/ # Cấu hình kết nối cơ sở dữ liệu │ └── database.php ├── customer/ # Chức năng khách hàng ├── database/ # Các tệp SQL │ ├── schema.sql │ ├── seed.sql │ └── ql_oto_dien.sql ├── includes/ # Thành phần PHP dùng chung ├── staff/ # Chức năng nhân viên ├── index.php # Trang chủ ├── .gitignore └── README.md

.gitkeep để giữ các thư mục trống git clone https://github.com/nguyenyen2006/QLKinhDoanhOToDien.git

Bước 3: Khởi động XAMPP

Mở XAMPP Control Panel và khởi động:

Apache

MySQL

Bước 4: Import cơ sở dữ liệu

1.Truy cập http://localhost/phpmyadmin. 2.Tạo database ql_oto_dien nếu chưa có. 3.Chọn database vừa tạo. 4.Vào tab Import. 5.Chọn tệp database/ql_oto_dien.sql. 6.Nhấn Import / Thực hiện.

Lưu ý: Chỉ cần Import tệp ql_oto_dien.sql trên database trống. Không chạy lại schema.sql. Bước 5: Kiểm tra kết nối database

Mở config/database.php và kiểm tra thông tin kết nối:

Các nhóm chức năng

     <!-- Khách vãng lai -->
Xem danh sách xe, tìm kiếm và so sánh xe Xem thông tin phiên bản và giá bán Đăng ký tài khoản

            <!-- Khách hàng -->
Đăng nhập, quản lý thông tin cá nhân Đăng ký lịch lái thử Đặt mua xe, theo dõi đơn mua

            <!-- Nhân viên -->
Xử lý lịch lái thử và đơn mua Quản lý hợp đồng Xác nhận thanh toán Thực hiện bàn giao xe

              <!-- Quản trị viên -->
Quản lý hãng xe, dòng xe, phiên bản xe Quản lý kho xe theo VIN Quản lý nhà cung cấp và phiếu nhập Quản lý khuyến mãi, tài khoản và báo cáo

Cơ sở dữ liệu
Hệ thống sử dụng database ql_oto_dien, gồm 17 bảng. Tệp SQL dùng để cài đặt nhanh: database/ql_oto_dien.sql.

Quy tắc làm việc nhóm
Không lập trình trực tiếp trên nhánh main. Mỗi thành viên tạo nhánh riêng để phát triển chức năng. Trước khi lập trình, cập nhật mã nguồn mới nhất từ main. Commit với nội dung mô tả rõ thay đổi. Tạo Pull Request để gộp chức năng vào main. Không tự ý thay đổi cấu trúc database khi chưa thống nhất với nhóm.

phân công mỗi thành viên làm web theo actor mà mình phụ trách vẽ sơ đồ use case

Actor /Người làm /Nội dung Header

-- Khách vãng lai /Hơn/ Logo, Trang chủ, Xe điện, So sánh xe, Đăng nhập, Đăng ký
-- Khách hàng /Yến / Logo, Trang chủ, Xe điện, So sánh xe, Lịch lái thử, Đơn mua, Tài khoản, Đăng xuất
-- Nhân viên / Header/ hoặc sidebar quản lý nghiệp vụ
-- Quản trị viên /Huy/ Header hoặc sidebar quản trị hệ thống
