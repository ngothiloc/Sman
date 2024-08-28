<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay đổi nếu bạn có user khác
$password = ""; // Thay đổi nếu bạn có password khác
$dbname = "sdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý dữ liệu khi người dùng nhấn nút "Tạo tài khoản"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra ràng buộc tên đăng nhập
    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $username)) {
        die("Tên đăng nhập phải bắt đầu bằng chữ cái và chỉ bao gồm chữ cái và số.");
    }

    // Kiểm tra ràng buộc mật khẩu
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        die("Mật khẩu phải có tối thiểu 8 ký tự, bao gồm chữ cái in thường, chữ cái in hoa, và số.");
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu
    $sql = "INSERT INTO user (name, email, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $username, $hashed_password);

    // Thực thi câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Đăng ký tài khoản thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Đăng ký tài khoản</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Sman</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Đăng ký tài khoản</h5>
                                        <p class="text-center small">Nhập thông tin của bạn để tạo tài khoản</p>
                                    </div>

                                    <form action="register.php" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Họ và tên</label>
                                            <input type="text" name="name" class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Vui lòng nhập họ và tên của bạn!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Vui lòng nhập đúng địa chỉ email!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Tên đăng nhập</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Tên đăng nhập phải bắt đầu bằng chữ cái và chỉ bao gồm chữ cái và số.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <!-- Sử dụng cùng lớp invalid-feedback cho thông báo mật khẩu -->
                                            <div class="invalid-feedback">Mật khẩu phải có tối thiểu 8 ký tự, bao gồm chữ cái in thường, chữ cái in hoa, và số.</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Tôi đồng ý
                                                    <a href="#">điều khoản và điều kiện của Sman</a></label>
                                                <div class="invalid-feedback">Bạn phải đồng ý trước khi tạo tài khoản</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Tạo tài khoản</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Bạn đã có tài khoản? <a href="dangnhap.html">Đăng nhập</a></p>
                                        </div>
                                    </form>



                                </div>
                            </div>

                            <div class="credits">

                                <div class="text-app-container">
                                    <div class="text-app">
                                        ĐÃ CÓ TRÊN MỌI NỀN TẢNG
                                    </div>
                                    <div class="container-app">
                                        <a href="#"><img src="assets/img/ios.png" alt="App Store"></a>
                                        <a href="#"><img src="assets/img/gg play.png" alt="Google Play"></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!--Ràng buộc mật khẩu -->
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const username = document.getElementById('yourUsername').value;
            const password = document.getElementById('yourPassword').value;
            const usernameInput = document.getElementById('yourUsername');
            const passwordInput = document.getElementById('yourPassword');

            let isValid = true;

            // Kiểm tra tên đăng nhập
            const usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/;
            if (!usernameRegex.test(username)) {
                usernameInput.classList.add('is-invalid');
                isValid = false;
            } else {
                usernameInput.classList.remove('is-invalid');
            }

            // Kiểm tra mật khẩu
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRegex.test(password)) {
                passwordInput.classList.add('is-invalid');
                isValid = false;
            } else {
                passwordInput.classList.remove('is-invalid');
            }

            // Ngăn chặn gửi form nếu không hợp lệ
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>





    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>