<?php
session_start();
include('db.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $name = $_POST['fullName'];
    $company = $_POST['company'];
    $job = $_POST['job'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name = ?, company = ?, job = ?, country = ?, address = ?, phone = ?, email = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $company, $job, $country, $address, $phone, $email, $username);
    $stmt->execute();
    $stmt->close();

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng hoặc thông báo cho người dùng biết cập nhật thành công
    header("Location: profile.php");
    exit();
}
?>