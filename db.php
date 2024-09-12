<?php
// db.php

// Bật hiển thị lỗi trong quá trình phát triển (chỉ nên bật trong môi trường phát triển)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Thiết lập thông tin kết nối đến database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdb";

try {
    // Thiết lập chế độ báo lỗi cho MySQLi
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    // Kết nối đến database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Thiết lập charset để tránh lỗi ký tự đặc biệt
    $conn->set_charset("utf8mb4");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        throw new Exception("Kết nối thất bại: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Hiển thị lỗi nếu có vấn đề xảy ra
    die($e->getMessage());
}
?>