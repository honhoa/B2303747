<?php
$csv = array();
$name_file = 'cus.csv';

if (file_exists($name_file)) {
    // Đọc từng dòng trong file csv vào mảng $lines
    $lines = file($name_file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $key => $value) {
        // Chuyển chuỗi CSV của mỗi dòng thành một mảng con
        $csv[$key] = str_getcsv($value);
    }
    
    // In cấu trúc mảng dữ liệu ra màn hình
    echo '<pre>';
    print_r($csv);
    echo '</pre>';
} else {
    echo "File $name_file khong ton tai!";
}
?>