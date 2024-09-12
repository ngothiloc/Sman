<?php
// Bắt đầu session
session_start();

// Kết nối đến database
include 'db.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: dangnhap.php");
    exit();
}

// Lấy tên từ database dựa vào tên đăng nhập từ session
$username = $_SESSION['username'];
$sql = "SELECT name FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sman</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

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

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="trangchu.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Sman</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Tìm kiếm" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Bạn có 4 thông báo
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Hiện tất cả</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Cảnh báo</h4>
                                <p>Thông báo cảnh báo bạn....</p>
                                <p>30 phút trước</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Nguy hiểm!</h4>
                                <p>Thông báo cảnh báo nguy hiểm!</p>
                                <p>1 giờ trước</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>An toàn</h4>
                                <p>Thông báo cảnh báo an toàn....</p>
                                <p>2 giờ trước</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Thông báo</h4>
                                <p>Hiển thị thông báo......</p>
                                <p>4 giờ trước</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Hiển thị tất cả tin nhắn</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            Bạn có 3 tin nhắn chưa đọc
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/logo.png" alt="" class="rounded-circle">
                                <div>
                                    <h4>Nguyễn Thị A</h4>
                                    <p>Tin ngắn sẽ hiển thị ở trong mục này...</p>
                                    <p>4 giờ trước</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/logo.png" alt="" class="rounded-circle">
                                <div>
                                    <h4>Nguyễn Văn B</h4>
                                    <p>Tin nhắn sẽ hiển thị ở mục này...</p>
                                    <p>6 giờ trước </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/logo.png" alt="" class="rounded-circle">
                                <div>
                                    <h4>Đoàn Văn A</h4>
                                    <p>Tin nhắn sẽ hiển thị ở mục này...</p>
                                    <p>8 giờ trước</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Hiển thị tất cả tin nhắn</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/logo.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo htmlspecialchars($name); ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo htmlspecialchars($name); ?></h6>
                            <span>Nghề nghiệp làm gì đó</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>Hồ sơ</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Chỉnh sửa thông tin</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
                                <i class="bi bi-question-circle"></i>
                                <span>Bạn cần trợ giúp?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>

            </ul>
        </nav><!-- End Icons Navigation -->



    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="trangchu.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Trang chủ</span>
                </a>
            </li><!-- End Trang chủ Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="gioithieu.php">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Giới thiệu</span>
                </a>
            </li><!-- End Trang chủ Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ketqua-nav" data-bs-toggle="collapse" href="#">
                    <i class="fas fa-vial"></i><span>Kết quả nghiên cứu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ketqua-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="baibao-quocte.php">
                            <i class="bi bi-circle"></i><span>Bài báo quốc tế</span>
                        </a>
                    </li>
                    <li>
                        <a href="baibao-trongnuoc.php">
                            <i class="bi bi-circle"></i><span>Bài báo trong nước</span>
                        </a>
                    </li>
                    <li>
                        <a href="donggop-dulieu.php">
                            <i class="bi bi-circle"></i><span>Đóng góp dữ liệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="lsdonggop-thanhtoan.php">
                            <i class="bi bi-circle"></i><span>Lịch sử đóng góp, thanh toán</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Kết quả nghiên cứu Nav -->

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#benh-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-virus"></i></i><span>Bệnh thuỷ sản</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="benh-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="danhsach-benh.php">
                            <i class="bi bi-circle"></i><span>Danh sách bệnh</span>
                        </a>
                    </li>
                    <li>
                        <a href="chuandoan.php" class="active">
                            <i class="bi bi-circle"></i><span>Chuẩn đoán bệnh</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End bệnh thuỷ sản Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#csdl-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-database"></i><span>Cơ sở dữ liệu</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="csdl-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="dulieu-nuoc.php">
                            <i class="bi bi-circle"></i><span>Dữ liệu chất lượng nước</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-khihau.php">
                            <i class="bi bi-circle"></i><span>Dữ liệu vi khí hậu, thời tiết vùng nuôi</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-domtrang.php">
                            <i class="bi bi-circle"></i><span>Dữ liệu bệnh đốm trắng</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-gan.php">
                            <i class="bi bi-circle"></i><span>Dữ liệu bệnh hoại tử gan tuỵ cấp</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Cơ sở dữ liệu Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="trangtrai.php">
                    <i class="fa-solid fa-shrimp"></i>
                    <span>Trang trại</span>
                </a>
            </li><!-- End trang trại Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ungdung-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-microchip"></i><span>Ứng dụng AI</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ungdung-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="mohinh-ai.php">
                            <i class="bi bi-circle"></i><span>Mô hình AI</span>
                        </a>
                    </li>
                    <li>
                        <a href="huongdan-sudung.php">
                            <i class="bi bi-circle"></i><span>Hướng dẫn sử dụng</span>
                        </a>
                    </li>
                    <li>
                        <a href="video-huongdan.php">
                            <i class="bi bi-circle"></i><span>Video hướng dẫn</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End ứng dụng AI Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="lienhe.php">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Liên hệ</span>
                </a>
            </li><!-- End liên hệ Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="tintuc.php">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Tin tức</span>
                </a>
            </li><!-- End tin tức Nav -->

            <li class="nav-heading">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Hồ sơ</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-heading">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#dangtin-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-microchip"></i><span>Đăng tin</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dangtin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="dangtin-capnhat.html">
                            <i class="bi bi-circle"></i><span>Đăng tin tức & cập nhật</span>
                        </a>
                    </li>
                    <li>
                        <a href="dangtin-benhtom.html">
                            <i class="bi bi-circle"></i><span>Đăng danh sách bệnh tôm</span>
                        </a>
                    </li>
                    <li>
                        <a href="dangtin/dangtin_benh.php">
                            <i class="bi bi-circle"></i><span>Đăng tin tức bệnh tôm</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="dangtin/dangtin_bao_quocte.php" >
                            <i class="bi bi-circle"></i><span>Đăng tin báo quốc tế</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="dangtin/dangtin_bao_trongnuoc.php">
                            <i class="bi bi-circle"></i><span>Đăng tin báo trong nước</span>
                        </a>
                    </li>                    
                </ul>
            </li><!-- End đăng tin Nav -->


        </ul>

    </aside><!-- End Sidebar-->
    


    <!-- ======= Main ======= -->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Chuẩn đoán bệnh tôm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Bệnh thuỷ sản</li>
                <li class="breadcrumb-item">Chuẩn đoán bệnh tôm</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <!-- Bảng Hiển Thị Dữ Liệu -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex; justify-content: space-between; align-items: center;">
                            Bảng chuẩn đoán bệnh tôm
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDiseaseModal">
                               
                                Thêm bệnh tôm
                            </button>
                        </h5>
                        <table class="table datatable table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên bệnh</th>
                                    <th>Triệu trứng</th>
                                    <th>Độ tuổi</th>
                                    <th>Nhiệt độ</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="diseaseTable">
                                <!-- Table data will be added here -->

                                <tr>
                                    <td>16</td>
                                    <td>2024-08-20 08:00</td>
                                    <td>70%</td>
                                    <td>27°C</td>
                                    <td>5.3 m/s</td>
                                    <td>Tây Bắc</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="addDiseaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm bệnh tôm</h5>
                   
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="diseaseForm">
                        <div class="form-group">
                            <label for="diseaseName">Tên bệnh</label>
                            <input type="text" class="form-control" id="diseaseName" required>
                        </div>
                        <div class="form-group">
                            <label for="symptoms">Triệu chứng</label>
                            <input type="text" class="form-control" id="symptoms" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Độ tuổi</label>
                            <input type="number" class="form-control" id="age" required>
                        </div>
                        <div class="form-group">
                            <label for="temperature">Nhiệt độ</label>
                            <input type="number" class="form-control" id="temperature" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <div class="container-sdt">
                    <div class="sdt">
                        Số điện thoại: (+84) 24 3756 8422 / (+84) 91 6661 078
                    </div>
                </div>
    
                <div class="container-email">
                    <div class="email">
                        Email: vanthu@creteach.vast.vn / namduongthanh@gmail.com
                    </div>
                </div>
    
                <div class="container-dc">
                    <div class="dc">
                        Địa chỉ: Nhà A28, Toà nhà Ươm tạo công nghệ - Số 18 Hoàng Quốc Việt, Phường Nghĩa Đô,
                        Quận Cầu Giấy, Thành phố Hà Nội
                    </div>
                </div>
            </div>
    
            <div class="footer-right">
                <div class="text-app-container">
                    <div class="text-app" style="font-size: medium;">
                        ĐÃ CÓ TRÊN MỌI NỀN TẢNG
                    </div>
                    <div class="container-app">
                        <a href="#"><img src="assets/img/ios.png" alt="App Store"></a>
                        <a href="#"><img src="assets/img/gg play.png" alt="Google Play"></a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-copy">
            <div class="copy">
                Copyright © 2024 Trung tâm Nghiên cứu và Phát triển công nghệ cao. All rights reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>