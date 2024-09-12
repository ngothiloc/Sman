<?php
session_start();
include 'db.php'; // Kết nối với cơ sở dữ liệu

// Kiểm tra action
$action = $_POST['action'];

if ($action === 'checkCurrentPassword') {
    $currentPassword = $_POST['currentPassword'];
    $username = $_SESSION['username']; // Giả sử bạn lưu username trong session

    // Kiểm tra mật khẩu cũ từ cơ sở dữ liệu
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($currentPassword, $dbPassword)) {
        echo 'valid';
    } else {
        echo 'invalid';
    }
}

if ($action === 'changePassword') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newpassword'];
    $username = $_SESSION['username'];

    // Kiểm tra mật khẩu cũ từ cơ sở dữ liệu
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($currentPassword, $dbPassword)) {
        // Nếu mật khẩu cũ đúng, cập nhật mật khẩu mới
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET password = ? WHERE username = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ss", $hashedNewPassword, $username);

        if ($updateStmt->execute()) {
            echo 'Mật khẩu đã được thay đổi thành công!';
        } else {
            echo 'Có lỗi xảy ra, vui lòng thử lại.';
        }

        $updateStmt->close();
    }
}

$conn->close();
?>