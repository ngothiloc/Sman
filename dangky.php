<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Tài khoản MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "sdb";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý dữ liệu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $terms = isset($_POST["terms"]);

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $checkEmailSql = "SELECT * FROM users WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailSql);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $emailResult = $checkEmailStmt->get_result();

    if ($emailResult->num_rows > 0) {
        echo "Email đã tồn tại. Vui lòng sử dụng email khác.";
        $checkEmailStmt->close();
        $conn->close();
        exit;
    }

    $checkEmailStmt->close();

    // Kiểm tra xem tên đăng nhập đã tồn tại trong cơ sở dữ liệu chưa
    $checkUsernameSql = "SELECT * FROM users WHERE username = ?";
    $checkUsernameStmt = $conn->prepare($checkUsernameSql);
    $checkUsernameStmt->bind_param("s", $username);
    $checkUsernameStmt->execute();
    $usernameResult = $checkUsernameStmt->get_result();

    if ($usernameResult->num_rows > 0) {
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
        $checkUsernameStmt->close();
        $conn->close();
        exit;
    }

    $checkUsernameStmt->close();

    // Băm mật khẩu trước khi lưu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng
    $sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $username, $hashed_password);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Tạo tài khoản thành công!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-alert {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050; /* Đảm bảo thông báo luôn hiển thị trên các phần tử khác */
            width: auto;
            max-width: 300px;
        }
    </style>

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



                                    <form action="dangky.php" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Họ và tên</label>
                                            <input type="text" name="name" class="form-control" id="yourName" required>
                                            <div id="name-feedback" class="invalid-feedback">
                                                Vui lòng nhập họ và tên của bạn!
                                            </div>
                                            <div id="name-requirements" class="invalid-feedback">
                                                Hãy nhập đúng tên của bạn!
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div id="email-feedback" class="invalid-feedback">
                                                Vui lòng nhập email của bạn!
                                            </div>
                                            <div id="email-requirements" class="invalid-feedback">
                                                Hãy nhập đúng email của bạn!
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Tên đăng nhập</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div id="username-feedback" class="invalid-feedback">
                                                    Vui lòng nhập tên đăng nhập!
                                                </div>
                                                <div id="username-requirements" class="invalid-feedback">
                                                    Tên đăng nhập phải bắt đầu bằng chữ cái.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" aria-describedby="inputGroupPrepend" required>
                                            <div id="invalid-feedback" class="invalid-feedback">
                                                Vui lòng nhập mật khẩu!
                                            </div>
                                            <div id="password-requirements" class="invalid-feedback">
                                                Mật khẩu phải có tối thiểu 8 ký tự, bao gồm chữ cái in thường, chữ cái in hoa, và số.
                                            </div>
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

    
<script>
    document.getElementById("yourPassword").addEventListener("input", function () {
        var inputField = this;
        var invalidFeedback = document.getElementById("invalid-feedback");
        var passwordRequirements = document.getElementById("password-requirements");
        var value = inputField.value;

        // Kiểm tra mật khẩu
        var hasLowercase = /[a-z]/.test(value);
        var hasUppercase = /[A-Z]/.test(value);
        var hasNumber = /[0-9]/.test(value);
        var isValidLength = value.length >= 8;

        if (value === '') {
            // Trường trống
            invalidFeedback.textContent = "Vui lòng nhập mật khẩu!";
            passwordRequirements.style.display = 'none';
            inputField.setCustomValidity("Vui lòng nhập mật khẩu!");
        } else if (!isValidLength || !hasLowercase || !hasUppercase || !hasNumber) {
            // Mật khẩu không hợp lệ
            invalidFeedback.textContent = "";
            passwordRequirements.style.display = 'block';
            inputField.setCustomValidity("Mật khẩu không hợp lệ!");
        } else {
            // Mật khẩu hợp lệ
            invalidFeedback.textContent = "";
            passwordRequirements.style.display = 'none';
            inputField.setCustomValidity("");
        }

        inputField.reportValidity(); // Hiển thị thông báo lỗi tùy chỉnh nếu có
    });
</script>

<script>
    document.getElementById("yourUsername").addEventListener("input", function () {
        var inputField = this;
        var feedback = document.getElementById("username-feedback");
        var requirements = document.getElementById("username-requirements");
        var value = inputField.value;

        // Kiểm tra tên đăng nhập
        var startsWithLetter = /^[a-zA-Z]/.test(value);

        if (value === '') {
            // Trường trống
            feedback.textContent = "Vui lòng nhập tên đăng nhập!";
            requirements.style.display = 'none';
            inputField.setCustomValidity("Vui lòng nhập tên đăng nhập!");
        } else if (!startsWithLetter) {
            // Tên đăng nhập không bắt đầu bằng chữ cái
            feedback.textContent = "";
            requirements.style.display = 'block';
            inputField.setCustomValidity("Tên đăng nhập phải bắt đầu bằng chữ cái.");
        } else {
            // Tên đăng nhập hợp lệ
            feedback.textContent = "";
            requirements.style.display = 'none';
            inputField.setCustomValidity("");
        }

        inputField.reportValidity(); // Hiển thị thông báo lỗi tùy chỉnh nếu có
    });
</script>

<script>
    document.getElementById("yourName").addEventListener("input", function () {
        var inputField = this;
        var feedback = document.getElementById("name-feedback");
        var requirements = document.getElementById("name-requirements");
        var value = inputField.value;

        // Danh sách các ký tự đặc biệt không được phép
        var specialChars = /[@#$%^&*()_+={}\[\]:;"'<>,.?/\\|`~]/;

        // Kiểm tra tên
        var startsWithCapitalLetter = /^[A-Z]/.test(value);
        var containsNoSpecialChars = !specialChars.test(value); // Đảm bảo không chứa ký tự đặc biệt

        if (value === '') {
            // Trường trống
            feedback.textContent = "Vui lòng nhập họ và tên của bạn!";
            requirements.style.display = 'none';
            inputField.setCustomValidity("Vui lòng nhập họ và tên của bạn!");
        } else if (!startsWithCapitalLetter || !containsNoSpecialChars) {
            // Tên không hợp lệ
            feedback.textContent = "";
            requirements.style.display = 'block';
            inputField.setCustomValidity("Tên của bạn phải bắt đầu bằng chữ cái viết hoa và không được chứa số hoặc các ký tự đặc biệt.");
        } else {
            // Tên hợp lệ
            feedback.textContent = "";
            requirements.style.display = 'none';
            inputField.setCustomValidity("");
        }

        inputField.reportValidity(); // Hiển thị thông báo lỗi tùy chỉnh nếu có
    });
</script>

<script>
    document.getElementById("yourEmail").addEventListener("input", function () {
        var inputField = this;
        var feedback = document.getElementById("email-feedback");
        var requirements = document.getElementById("email-requirements");
        var value = inputField.value;

        // Kiểm tra định dạng email
        var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

        if (value === '') {
            // Trường trống
            feedback.textContent = "Vui lòng nhập email của bạn!";
            requirements.style.display = 'none';
            inputField.setCustomValidity("Vui lòng nhập email của bạn!");
        } else if (!isValidEmail) {
            // Email không đúng định dạng
            feedback.textContent = "";
            requirements.textContent = "Hãy nhập đúng email của bạn!";
            requirements.style.display = 'block';
            inputField.setCustomValidity("Hãy nhập đúng email của bạn!");
        } else {
            // Email hợp lệ
            feedback.textContent = "";
            requirements.style.display = 'none';
            inputField.setCustomValidity("");
        }

        inputField.reportValidity(); // Hiển thị thông báo lỗi tùy chỉnh nếu có
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