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
                            <a class="dropdown-item d-flex align-items-center" href="lienhe.php">
                                <i class="bi bi-question-circle"></i>
                                <span>Bạn cần trợ giúp?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.html">
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
                <a class="nav-link collapsed" data-bs-target="#benh-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-virus"></i></i><span>Bệnh thuỷ sản</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="benh-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="danhsach-benh.php">
                            <i class="bi bi-circle"></i><span>Danh sách bệnh</span>
                        </a>
                    </li>
                    <li>
                        <a href="chuandoan.php">
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
                <ul id="csdl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                <a class="nav-link" href="trangtrai.php">
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
            <h1>Trang trại</h1>
        </div><!-- End Page Title -->
    
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="margin: 20px;">
                          
                    
                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100 active" id="qlyao-tab" data-bs-toggle="tab"
                                        data-bs-target="#qlyao-justified" type="button" role="tab" aria-controls="qlyao" aria-selected="true">Quản lý ao nuôi</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="qlytom-tab" data-bs-toggle="tab" data-bs-target="#qlytom-justified"
                                        type="button" role="tab" aria-controls="qlytom" aria-selected="false">Quản lý tôm nuôi</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="qlysk-tab" data-bs-toggle="tab" data-bs-target="#qlysk-justified"
                                        type="button" role="tab" aria-controls="qlysk" aria-selected="false">Quản lý sức khoẻ tôm</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="qlythucan-tab" data-bs-toggle="tab" data-bs-target="#qlythucan-justified"
                                        type="button" role="tab" aria-controls="qlythucan" aria-selected="false">Quản lý thức ăn, dinh dưỡng</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="qlyao-justified" role="tabpanel" aria-labelledby="qlyao-tab">
                                    <!-- botton -->
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="card-title mb-0"></h5>
                                        </div>
                                        <div class="col-auto" style="padding: 0 23px 10px 0;">
                                            <button id="add-row-btn" class="btn btn-success">Thêm Hàng Mới</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable table-striped">
                                    
                                        <thead>
                                    
                                            <tr>
                                                <th>Diện tích</th>
                                                <th>Vị trí</th>
                                                <th>Nhiệt độ</th>
                                                <th>pH</th>
                                                <th>Oxy hoà tan</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Unity Pugh</td>
                                                <td>9958</td>
                                                <td>Curicó</td>
                                                <td>2005/02/11</td>
                                                <td>37%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Theodore Duran</td>
                                                <td>8971</td>
                                                <td>Dhanbad</td>
                                                <td>1999/04/07</td>
                                                <td>97%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kylie Bishop</td>
                                                <td>3147</td>
                                                <td>Norman</td>
                                                <td>2005/09/08</td>
                                                <td>63%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Willow Gilliam</td>
                                                <td>3497</td>
                                                <td>Amqui</td>
                                                <td>2009/29/11</td>
                                                <td>30%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Blossom Dickerson</td>
                                                <td>5018</td>
                                                <td>Kempten</td>
                                                <td>2006/11/09</td>
                                                <td>17%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Elliott Snyder</td>
                                                <td>3925</td>
                                                <td>Enines</td>
                                                <td>2006/03/08</td>
                                                <td>57%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Castor Pugh</td>
                                                <td>9488</td>
                                                <td>Neath</td>
                                                <td>2014/23/12</td>
                                                <td>93%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pearl Carlson</td>
                                                <td>6231</td>
                                                <td>Cobourg</td>
                                                <td>2014/31/08</td>
                                                <td>100%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deirdre Bridges</td>
                                                <td>1579</td>
                                                <td>Eberswalde-Finow</td>
                                                <td>2014/26/08</td>
                                                <td>44%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Daniel Baldwin</td>
                                                <td>6095</td>
                                                <td>Moircy</td>
                                                <td>2000/11/01</td>
                                                <td>33%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phelan Kane</td>
                                                <td>9519</td>
                                                <td>Germersheim</td>
                                                <td>1999/16/04</td>
                                                <td>77%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quentin Salas</td>
                                                <td>1339</td>
                                                <td>Los Andes</td>
                                                <td>2011/26/01</td>
                                                <td>49%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Armand Suarez</td>
                                                <td>6583</td>
                                                <td>Funtua</td>
                                                <td>1999/06/11</td>
                                                <td>9%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gretchen Rogers</td>
                                                <td>5393</td>
                                                <td>Moxhe</td>
                                                <td>1998/26/10</td>
                                                <td>24%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harding Thompson</td>
                                                <td>2824</td>
                                                <td>Abeokuta</td>
                                                <td>2008/06/08</td>
                                                <td>10%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mira Rocha</td>
                                                <td>4393</td>
                                                <td>Port Harcourt</td>
                                                <td>2002/04/10</td>
                                                <td>14%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Drew Phillips</td>
                                                <td>2931</td>
                                                <td>Goes</td>
                                                <td>2011/18/10</td>
                                                <td>58%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Emerald Warner</td>
                                                <td>6205</td>
                                                <td>Chiavari</td>
                                                <td>2002/08/04</td>
                                                <td>58%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Colin Burch</td>
                                                <td>7457</td>
                                                <td>Anamur</td>
                                                <td>2004/02/01</td>
                                                <td>34%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Russell Haynes</td>
                                                <td>8916</td>
                                                <td>Frascati</td>
                                                <td>2015/28/04</td>
                                                <td>18%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Brennan Brooks</td>
                                                <td>9011</td>
                                                <td>Olmué</td>
                                                <td>2000/18/04</td>
                                                <td>2%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kane Anthony</td>
                                                <td>8075</td>
                                                <td>LaSalle</td>
                                                <td>2006/21/05</td>
                                                <td>93%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Scarlett Hurst</td>
                                                <td>1019</td>
                                                <td>Brampton</td>
                                                <td>2015/07/01</td>
                                                <td>94%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>James Scott</td>
                                                <td>3008</td>
                                                <td>Meux</td>
                                                <td>2007/30/05</td>
                                                <td>55%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Desiree Ferguson</td>
                                                <td>9054</td>
                                                <td>Gojra</td>
                                                <td>2009/15/02</td>
                                                <td>81%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Elaine Bishop</td>
                                                <td>9160</td>
                                                <td>Petrópolis</td>
                                                <td>2008/23/12</td>
                                                <td>48%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hilda Nelson</td>
                                                <td>6307</td>
                                                <td>Posina</td>
                                                <td>2004/23/05</td>
                                                <td>76%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Evangeline Beasley</td>
                                                <td>3820</td>
                                                <td>Caplan</td>
                                                <td>2009/12/03</td>
                                                <td>62%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Wyatt Riley</td>
                                                <td>5694</td>
                                                <td>Cavaion Veronese</td>
                                                <td>2012/19/02</td>
                                                <td>67%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Wyatt Mccarthy</td>
                                                <td>3547</td>
                                                <td>Patan</td>
                                                <td>2014/23/06</td>
                                                <td>9%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cairo Rice</td>
                                                <td>6273</td>
                                                <td>Ostra Vetere</td>
                                                <td>2016/27/02</td>
                                                <td>13%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sylvia Peters</td>
                                                <td>6829</td>
                                                <td>Arrah</td>
                                                <td>2015/03/02</td>
                                                <td>13%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kasper Craig</td>
                                                <td>5515</td>
                                                <td>Firenze</td>
                                                <td>2015/26/04</td>
                                                <td>56%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Leigh Ruiz</td>
                                                <td>5112</td>
                                                <td>Lac Ste. Anne</td>
                                                <td>2001/09/02</td>
                                                <td>28%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Athena Aguirre</td>
                                                <td>5741</td>
                                                <td>Romeral</td>
                                                <td>2010/24/03</td>
                                                <td>15%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Riley Nunez</td>
                                                <td>5533</td>
                                                <td>Sart-Eustache</td>
                                                <td>2003/26/02</td>
                                                <td>30%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lois Talley</td>
                                                <td>9393</td>
                                                <td>Dorchester</td>
                                                <td>2014/05/01</td>
                                                <td>51%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hop Bass</td>
                                                <td>1024</td>
                                                <td>Westerlo</td>
                                                <td>2012/25/09</td>
                                                <td>85%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kalia Diaz</td>
                                                <td>9184</td>
                                                <td>Ichalkaranji</td>
                                                <td>2013/26/06</td>
                                                <td>92%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maia Pate</td>
                                                <td>6682</td>
                                                <td>Louvain-la-Neuve</td>
                                                <td>2011/23/04</td>
                                                <td>50%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Macaulay Pruitt</td>
                                                <td>4457</td>
                                                <td>Fraser-Fort George</td>
                                                <td>2015/03/08</td>
                                                <td>92%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Danielle Oconnor</td>
                                                <td>9464</td>
                                                <td>Neuwied</td>
                                                <td>2001/05/10</td>
                                                <td>17%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kato Carr</td>
                                                <td>4842</td>
                                                <td>Faridabad</td>
                                                <td>2012/11/05</td>
                                                <td>96%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Malachi Mejia</td>
                                                <td>7133</td>
                                                <td>Vorst</td>
                                                <td>2007/25/04</td>
                                                <td>26%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dominic Carver</td>
                                                <td>3476</td>
                                                <td>Pointe-aux-Trembles</td>
                                                <td>2014/14/03</td>
                                                <td>71%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Paki Santos</td>
                                                <td>4424</td>
                                                <td>Cache Creek</td>
                                                <td>2001/18/11</td>
                                                <td>82%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ross Hodges</td>
                                                <td>1862</td>
                                                <td>Trazegnies</td>
                                                <td>2010/19/09</td>
                                                <td>87%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hilda Whitley</td>
                                                <td>3514</td>
                                                <td>New Sarepta</td>
                                                <td>2011/05/07</td>
                                                <td>94%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Roth Cherry</td>
                                                <td>4006</td>
                                                <td>Flin Flon</td>
                                                <td>2008/02/09</td>
                                                <td>8%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lareina Jones</td>
                                                <td>8642</td>
                                                <td>East Linton</td>
                                                <td>2009/07/08</td>
                                                <td>21%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Joshua Weiss</td>
                                                <td>2289</td>
                                                <td>Saint-Léonard</td>
                                                <td>2010/15/01</td>
                                                <td>52%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kiona Lowery</td>
                                                <td>5952</td>
                                                <td>Inuvik</td>
                                                <td>2002/17/12</td>
                                                <td>72%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nina Rush</td>
                                                <td>7567</td>
                                                <td>Bo‘lhe</td>
                                                <td>2008/27/01</td>
                                                <td>6%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Palmer Parker</td>
                                                <td>2000</td>
                                                <td>Stade</td>
                                                <td>2012/24/07</td>
                                                <td>58%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vielka Olsen</td>
                                                <td>3745</td>
                                                <td>Vrasene</td>
                                                <td>2016/08/01</td>
                                                <td>70%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Meghan Cunningham</td>
                                                <td>8604</td>
                                                <td>Söke</td>
                                                <td>2007/16/02</td>
                                                <td>59%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Iola Shaw</td>
                                                <td>6447</td>
                                                <td>Albany</td>
                                                <td>2014/05/03</td>
                                                <td>88%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Imelda Cole</td>
                                                <td>4564</td>
                                                <td>Haasdonk</td>
                                                <td>2007/16/11</td>
                                                <td>79%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jerry Beach</td>
                                                <td>6801</td>
                                                <td>Gattatico</td>
                                                <td>1999/07/07</td>
                                                <td>36%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Rocha</td>
                                                <td>3938</td>
                                                <td>Gavorrano</td>
                                                <td>2000/06/08</td>
                                                <td>71%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Derek Kerr</td>
                                                <td>1724</td>
                                                <td>Gualdo Cattaneo</td>
                                                <td>2014/21/01</td>
                                                <td>89%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shad Hudson</td>
                                                <td>5944</td>
                                                <td>Salamanca</td>
                                                <td>2014/10/12</td>
                                                <td>98%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Daryl Ayers</td>
                                                <td>8276</td>
                                                <td>Barchi</td>
                                                <td>2012/12/11</td>
                                                <td>88%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Caleb Livingston</td>
                                                <td>3094</td>
                                                <td>Fatehpur</td>
                                                <td>2014/13/02</td>
                                                <td>8%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sydney Meyer</td>
                                                <td>4576</td>
                                                <td>Neubrandenburg</td>
                                                <td>2015/06/02</td>
                                                <td>22%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lani Lawrence</td>
                                                <td>8501</td>
                                                <td>Turnhout</td>
                                                <td>2008/07/05</td>
                                                <td>16%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Allegra Shepherd</td>
                                                <td>2576</td>
                                                <td>Meeuwen-Gruitrode</td>
                                                <td>2004/19/04</td>
                                                <td>41%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fallon Reyes</td>
                                                <td>3178</td>
                                                <td>Monceau-sur-Sambre</td>
                                                <td>2005/15/02</td>
                                                <td>16%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Karen Whitley</td>
                                                <td>4357</td>
                                                <td>Sluis</td>
                                                <td>2003/02/05</td>
                                                <td>23%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Stewart Stephenson</td>
                                                <td>5350</td>
                                                <td>Villa Faraldi</td>
                                                <td>2003/05/07</td>
                                                <td>65%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ursula Reynolds</td>
                                                <td>7544</td>
                                                <td>Southampton</td>
                                                <td>1999/16/12</td>
                                                <td>61%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Adrienne Winters</td>
                                                <td>4425</td>
                                                <td>Laguna Blanca</td>
                                                <td>2014/15/09</td>
                                                <td>24%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Francesca Brock</td>
                                                <td>1337</td>
                                                <td>Oban</td>
                                                <td>2000/12/06</td>
                                                <td>90%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ursa Davenport</td>
                                                <td>7629</td>
                                                <td>New Plymouth</td>
                                                <td>2013/27/06</td>
                                                <td>37%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mark Brock</td>
                                                <td>3310</td>
                                                <td>Veenendaal</td>
                                                <td>2006/08/09</td>
                                                <td>41%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dale Rush</td>
                                                <td>5050</td>
                                                <td>Chicoutimi</td>
                                                <td>2000/27/03</td>
                                                <td>2%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shellie Murphy</td>
                                                <td>3845</td>
                                                <td>Marlborough</td>
                                                <td>2013/13/11</td>
                                                <td>72%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Porter Nicholson</td>
                                                <td>4539</td>
                                                <td>Bismil</td>
                                                <td>2012/22/10</td>
                                                <td>23%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oliver Huber</td>
                                                <td>1265</td>
                                                <td>Hannche</td>
                                                <td>2002/11/01</td>
                                                <td>94%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Calista Maynard</td>
                                                <td>3315</td>
                                                <td>Pozzuolo del Friuli</td>
                                                <td>2006/23/03</td>
                                                <td>5%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lois Vargas</td>
                                                <td>6825</td>
                                                <td>Cumberland</td>
                                                <td>1999/25/04</td>
                                                <td>50%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hermione Dickson</td>
                                                <td>2785</td>
                                                <td>Woodstock</td>
                                                <td>2001/22/03</td>
                                                <td>2%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dalton Jennings</td>
                                                <td>5416</td>
                                                <td>Dudzele</td>
                                                <td>2015/09/02</td>
                                                <td>74%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cathleen Kramer</td>
                                                <td>3380</td>
                                                <td>Crowsnest Pass</td>
                                                <td>2012/27/07</td>
                                                <td>53%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Zachery Morgan</td>
                                                <td>6730</td>
                                                <td>Collines-de-l'Outaouais</td>
                                                <td>2006/04/09</td>
                                                <td>51%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Yoko Freeman</td>
                                                <td>4077</td>
                                                <td>Lidköping</td>
                                                <td>2002/27/12</td>
                                                <td>48%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Chaim Waller</td>
                                                <td>4240</td>
                                                <td>North Shore</td>
                                                <td>2010/25/07</td>
                                                <td>25%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Berk Johnston</td>
                                                <td>4532</td>
                                                <td>Vergnies</td>
                                                <td>2016/23/02</td>
                                                <td>93%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tad Munoz</td>
                                                <td>2902</td>
                                                <td>Saint-Nazaire</td>
                                                <td>2010/09/05</td>
                                                <td>65%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vivien Dominguez</td>
                                                <td>5653</td>
                                                <td>Bargagli</td>
                                                <td>2001/09/01</td>
                                                <td>86%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Carissa Lara</td>
                                                <td>3241</td>
                                                <td>Sherborne</td>
                                                <td>2015/07/12</td>
                                                <td>72%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hammett Gordon</td>
                                                <td>8101</td>
                                                <td>Wah</td>
                                                <td>1998/06/09</td>
                                                <td>20%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Walker Nixon</td>
                                                <td>6901</td>
                                                <td>Metz</td>
                                                <td>2011/12/11</td>
                                                <td>41%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nathan Espinoza</td>
                                                <td>5956</td>
                                                <td>Strathcona County</td>
                                                <td>2002/25/01</td>
                                                <td>47%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kelly Cameron</td>
                                                <td>4836</td>
                                                <td>Fontaine-Valmont</td>
                                                <td>1999/02/07</td>
                                                <td>24%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kyra Moses</td>
                                                <td>3796</td>
                                                <td>Quenast</td>
                                                <td>1998/07/07</td>
                                                <td>68%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Grace Bishop</td>
                                                <td>8340</td>
                                                <td>Rodez</td>
                                                <td>2012/02/10</td>
                                                <td>4%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Haviva Hernandez</td>
                                                <td>8136</td>
                                                <td>Suwałki</td>
                                                <td>2000/30/01</td>
                                                <td>16%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alisa Horn</td>
                                                <td>9853</td>
                                                <td>Ucluelet</td>
                                                <td>2007/01/11</td>
                                                <td>39%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Zelenia Roman</td>
                                                <td>7516</td>
                                                <td>Redwater</td>
                                                <td>2012/03/03</td>
                                                <td>31%</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                                <div class="tab-pane fade" id="qlytom-justified" role="tabpanel" aria-labelledby="qlytom-tab">
                                <!-- Table with stripped rows -->
                                <!-- botton -->
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-0"></h5>
                                    </div>
                                    <div class="col-auto" style="padding: 0 23px 10px 0;">
                                        <button id="add-row-btn" class="btn btn-success">Thêm Hàng Mới</button>
                                    </div>
                                </div>
                                
                                <!-- Table with stripped rows -->
                                <table class="table datatable table-striped">
                                
                                    <thead>
                                
                                        <tr>
                                            <th>Số lượng</th>
                                            <th>Nguồn gốc</th>
                                            <th>Ngày thả giống</th>
                                            <th>Trạng thái hiện tại</th>
                                            <th>Trạng thái tôm</th>
                                            <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Unity Pugh</td>
                                            <td>9958</td>
                                            <td>Curicó</td>
                                            <td>2005/02/11</td>
                                            <td>37%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Theodore Duran</td>
                                            <td>8971</td>
                                            <td>Dhanbad</td>
                                            <td>1999/04/07</td>
                                            <td>97%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kylie Bishop</td>
                                            <td>3147</td>
                                            <td>Norman</td>
                                            <td>2005/09/08</td>
                                            <td>63%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Willow Gilliam</td>
                                            <td>3497</td>
                                            <td>Amqui</td>
                                            <td>2009/29/11</td>
                                            <td>30%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Blossom Dickerson</td>
                                            <td>5018</td>
                                            <td>Kempten</td>
                                            <td>2006/11/09</td>
                                            <td>17%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Elliott Snyder</td>
                                            <td>3925</td>
                                            <td>Enines</td>
                                            <td>2006/03/08</td>
                                            <td>57%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Castor Pugh</td>
                                            <td>9488</td>
                                            <td>Neath</td>
                                            <td>2014/23/12</td>
                                            <td>93%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pearl Carlson</td>
                                            <td>6231</td>
                                            <td>Cobourg</td>
                                            <td>2014/31/08</td>
                                            <td>100%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Deirdre Bridges</td>
                                            <td>1579</td>
                                            <td>Eberswalde-Finow</td>
                                            <td>2014/26/08</td>
                                            <td>44%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Daniel Baldwin</td>
                                            <td>6095</td>
                                            <td>Moircy</td>
                                            <td>2000/11/01</td>
                                            <td>33%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phelan Kane</td>
                                            <td>9519</td>
                                            <td>Germersheim</td>
                                            <td>1999/16/04</td>
                                            <td>77%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quentin Salas</td>
                                            <td>1339</td>
                                            <td>Los Andes</td>
                                            <td>2011/26/01</td>
                                            <td>49%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Armand Suarez</td>
                                            <td>6583</td>
                                            <td>Funtua</td>
                                            <td>1999/06/11</td>
                                            <td>9%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gretchen Rogers</td>
                                            <td>5393</td>
                                            <td>Moxhe</td>
                                            <td>1998/26/10</td>
                                            <td>24%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harding Thompson</td>
                                            <td>2824</td>
                                            <td>Abeokuta</td>
                                            <td>2008/06/08</td>
                                            <td>10%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mira Rocha</td>
                                            <td>4393</td>
                                            <td>Port Harcourt</td>
                                            <td>2002/04/10</td>
                                            <td>14%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Drew Phillips</td>
                                            <td>2931</td>
                                            <td>Goes</td>
                                            <td>2011/18/10</td>
                                            <td>58%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Emerald Warner</td>
                                            <td>6205</td>
                                            <td>Chiavari</td>
                                            <td>2002/08/04</td>
                                            <td>58%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Colin Burch</td>
                                            <td>7457</td>
                                            <td>Anamur</td>
                                            <td>2004/02/01</td>
                                            <td>34%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Russell Haynes</td>
                                            <td>8916</td>
                                            <td>Frascati</td>
                                            <td>2015/28/04</td>
                                            <td>18%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Brennan Brooks</td>
                                            <td>9011</td>
                                            <td>Olmué</td>
                                            <td>2000/18/04</td>
                                            <td>2%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kane Anthony</td>
                                            <td>8075</td>
                                            <td>LaSalle</td>
                                            <td>2006/21/05</td>
                                            <td>93%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Scarlett Hurst</td>
                                            <td>1019</td>
                                            <td>Brampton</td>
                                            <td>2015/07/01</td>
                                            <td>94%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>James Scott</td>
                                            <td>3008</td>
                                            <td>Meux</td>
                                            <td>2007/30/05</td>
                                            <td>55%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Desiree Ferguson</td>
                                            <td>9054</td>
                                            <td>Gojra</td>
                                            <td>2009/15/02</td>
                                            <td>81%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Elaine Bishop</td>
                                            <td>9160</td>
                                            <td>Petrópolis</td>
                                            <td>2008/23/12</td>
                                            <td>48%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hilda Nelson</td>
                                            <td>6307</td>
                                            <td>Posina</td>
                                            <td>2004/23/05</td>
                                            <td>76%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Evangeline Beasley</td>
                                            <td>3820</td>
                                            <td>Caplan</td>
                                            <td>2009/12/03</td>
                                            <td>62%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wyatt Riley</td>
                                            <td>5694</td>
                                            <td>Cavaion Veronese</td>
                                            <td>2012/19/02</td>
                                            <td>67%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wyatt Mccarthy</td>
                                            <td>3547</td>
                                            <td>Patan</td>
                                            <td>2014/23/06</td>
                                            <td>9%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cairo Rice</td>
                                            <td>6273</td>
                                            <td>Ostra Vetere</td>
                                            <td>2016/27/02</td>
                                            <td>13%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sylvia Peters</td>
                                            <td>6829</td>
                                            <td>Arrah</td>
                                            <td>2015/03/02</td>
                                            <td>13%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kasper Craig</td>
                                            <td>5515</td>
                                            <td>Firenze</td>
                                            <td>2015/26/04</td>
                                            <td>56%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Leigh Ruiz</td>
                                            <td>5112</td>
                                            <td>Lac Ste. Anne</td>
                                            <td>2001/09/02</td>
                                            <td>28%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Athena Aguirre</td>
                                            <td>5741</td>
                                            <td>Romeral</td>
                                            <td>2010/24/03</td>
                                            <td>15%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Riley Nunez</td>
                                            <td>5533</td>
                                            <td>Sart-Eustache</td>
                                            <td>2003/26/02</td>
                                            <td>30%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lois Talley</td>
                                            <td>9393</td>
                                            <td>Dorchester</td>
                                            <td>2014/05/01</td>
                                            <td>51%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hop Bass</td>
                                            <td>1024</td>
                                            <td>Westerlo</td>
                                            <td>2012/25/09</td>
                                            <td>85%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kalia Diaz</td>
                                            <td>9184</td>
                                            <td>Ichalkaranji</td>
                                            <td>2013/26/06</td>
                                            <td>92%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maia Pate</td>
                                            <td>6682</td>
                                            <td>Louvain-la-Neuve</td>
                                            <td>2011/23/04</td>
                                            <td>50%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Macaulay Pruitt</td>
                                            <td>4457</td>
                                            <td>Fraser-Fort George</td>
                                            <td>2015/03/08</td>
                                            <td>92%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Danielle Oconnor</td>
                                            <td>9464</td>
                                            <td>Neuwied</td>
                                            <td>2001/05/10</td>
                                            <td>17%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kato Carr</td>
                                            <td>4842</td>
                                            <td>Faridabad</td>
                                            <td>2012/11/05</td>
                                            <td>96%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Malachi Mejia</td>
                                            <td>7133</td>
                                            <td>Vorst</td>
                                            <td>2007/25/04</td>
                                            <td>26%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dominic Carver</td>
                                            <td>3476</td>
                                            <td>Pointe-aux-Trembles</td>
                                            <td>2014/14/03</td>
                                            <td>71%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Paki Santos</td>
                                            <td>4424</td>
                                            <td>Cache Creek</td>
                                            <td>2001/18/11</td>
                                            <td>82%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ross Hodges</td>
                                            <td>1862</td>
                                            <td>Trazegnies</td>
                                            <td>2010/19/09</td>
                                            <td>87%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hilda Whitley</td>
                                            <td>3514</td>
                                            <td>New Sarepta</td>
                                            <td>2011/05/07</td>
                                            <td>94%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roth Cherry</td>
                                            <td>4006</td>
                                            <td>Flin Flon</td>
                                            <td>2008/02/09</td>
                                            <td>8%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lareina Jones</td>
                                            <td>8642</td>
                                            <td>East Linton</td>
                                            <td>2009/07/08</td>
                                            <td>21%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Joshua Weiss</td>
                                            <td>2289</td>
                                            <td>Saint-Léonard</td>
                                            <td>2010/15/01</td>
                                            <td>52%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kiona Lowery</td>
                                            <td>5952</td>
                                            <td>Inuvik</td>
                                            <td>2002/17/12</td>
                                            <td>72%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nina Rush</td>
                                            <td>7567</td>
                                            <td>Bo‘lhe</td>
                                            <td>2008/27/01</td>
                                            <td>6%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Palmer Parker</td>
                                            <td>2000</td>
                                            <td>Stade</td>
                                            <td>2012/24/07</td>
                                            <td>58%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vielka Olsen</td>
                                            <td>3745</td>
                                            <td>Vrasene</td>
                                            <td>2016/08/01</td>
                                            <td>70%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Meghan Cunningham</td>
                                            <td>8604</td>
                                            <td>Söke</td>
                                            <td>2007/16/02</td>
                                            <td>59%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Iola Shaw</td>
                                            <td>6447</td>
                                            <td>Albany</td>
                                            <td>2014/05/03</td>
                                            <td>88%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Imelda Cole</td>
                                            <td>4564</td>
                                            <td>Haasdonk</td>
                                            <td>2007/16/11</td>
                                            <td>79%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jerry Beach</td>
                                            <td>6801</td>
                                            <td>Gattatico</td>
                                            <td>1999/07/07</td>
                                            <td>36%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Rocha</td>
                                            <td>3938</td>
                                            <td>Gavorrano</td>
                                            <td>2000/06/08</td>
                                            <td>71%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Derek Kerr</td>
                                            <td>1724</td>
                                            <td>Gualdo Cattaneo</td>
                                            <td>2014/21/01</td>
                                            <td>89%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shad Hudson</td>
                                            <td>5944</td>
                                            <td>Salamanca</td>
                                            <td>2014/10/12</td>
                                            <td>98%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Daryl Ayers</td>
                                            <td>8276</td>
                                            <td>Barchi</td>
                                            <td>2012/12/11</td>
                                            <td>88%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Caleb Livingston</td>
                                            <td>3094</td>
                                            <td>Fatehpur</td>
                                            <td>2014/13/02</td>
                                            <td>8%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sydney Meyer</td>
                                            <td>4576</td>
                                            <td>Neubrandenburg</td>
                                            <td>2015/06/02</td>
                                            <td>22%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lani Lawrence</td>
                                            <td>8501</td>
                                            <td>Turnhout</td>
                                            <td>2008/07/05</td>
                                            <td>16%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Allegra Shepherd</td>
                                            <td>2576</td>
                                            <td>Meeuwen-Gruitrode</td>
                                            <td>2004/19/04</td>
                                            <td>41%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fallon Reyes</td>
                                            <td>3178</td>
                                            <td>Monceau-sur-Sambre</td>
                                            <td>2005/15/02</td>
                                            <td>16%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Karen Whitley</td>
                                            <td>4357</td>
                                            <td>Sluis</td>
                                            <td>2003/02/05</td>
                                            <td>23%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Stewart Stephenson</td>
                                            <td>5350</td>
                                            <td>Villa Faraldi</td>
                                            <td>2003/05/07</td>
                                            <td>65%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ursula Reynolds</td>
                                            <td>7544</td>
                                            <td>Southampton</td>
                                            <td>1999/16/12</td>
                                            <td>61%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Adrienne Winters</td>
                                            <td>4425</td>
                                            <td>Laguna Blanca</td>
                                            <td>2014/15/09</td>
                                            <td>24%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Francesca Brock</td>
                                            <td>1337</td>
                                            <td>Oban</td>
                                            <td>2000/12/06</td>
                                            <td>90%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ursa Davenport</td>
                                            <td>7629</td>
                                            <td>New Plymouth</td>
                                            <td>2013/27/06</td>
                                            <td>37%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mark Brock</td>
                                            <td>3310</td>
                                            <td>Veenendaal</td>
                                            <td>2006/08/09</td>
                                            <td>41%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dale Rush</td>
                                            <td>5050</td>
                                            <td>Chicoutimi</td>
                                            <td>2000/27/03</td>
                                            <td>2%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shellie Murphy</td>
                                            <td>3845</td>
                                            <td>Marlborough</td>
                                            <td>2013/13/11</td>
                                            <td>72%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Porter Nicholson</td>
                                            <td>4539</td>
                                            <td>Bismil</td>
                                            <td>2012/22/10</td>
                                            <td>23%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Oliver Huber</td>
                                            <td>1265</td>
                                            <td>Hannche</td>
                                            <td>2002/11/01</td>
                                            <td>94%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Calista Maynard</td>
                                            <td>3315</td>
                                            <td>Pozzuolo del Friuli</td>
                                            <td>2006/23/03</td>
                                            <td>5%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lois Vargas</td>
                                            <td>6825</td>
                                            <td>Cumberland</td>
                                            <td>1999/25/04</td>
                                            <td>50%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hermione Dickson</td>
                                            <td>2785</td>
                                            <td>Woodstock</td>
                                            <td>2001/22/03</td>
                                            <td>2%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dalton Jennings</td>
                                            <td>5416</td>
                                            <td>Dudzele</td>
                                            <td>2015/09/02</td>
                                            <td>74%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cathleen Kramer</td>
                                            <td>3380</td>
                                            <td>Crowsnest Pass</td>
                                            <td>2012/27/07</td>
                                            <td>53%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Zachery Morgan</td>
                                            <td>6730</td>
                                            <td>Collines-de-l'Outaouais</td>
                                            <td>2006/04/09</td>
                                            <td>51%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Yoko Freeman</td>
                                            <td>4077</td>
                                            <td>Lidköping</td>
                                            <td>2002/27/12</td>
                                            <td>48%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chaim Waller</td>
                                            <td>4240</td>
                                            <td>North Shore</td>
                                            <td>2010/25/07</td>
                                            <td>25%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Berk Johnston</td>
                                            <td>4532</td>
                                            <td>Vergnies</td>
                                            <td>2016/23/02</td>
                                            <td>93%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tad Munoz</td>
                                            <td>2902</td>
                                            <td>Saint-Nazaire</td>
                                            <td>2010/09/05</td>
                                            <td>65%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vivien Dominguez</td>
                                            <td>5653</td>
                                            <td>Bargagli</td>
                                            <td>2001/09/01</td>
                                            <td>86%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Carissa Lara</td>
                                            <td>3241</td>
                                            <td>Sherborne</td>
                                            <td>2015/07/12</td>
                                            <td>72%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hammett Gordon</td>
                                            <td>8101</td>
                                            <td>Wah</td>
                                            <td>1998/06/09</td>
                                            <td>20%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Walker Nixon</td>
                                            <td>6901</td>
                                            <td>Metz</td>
                                            <td>2011/12/11</td>
                                            <td>41%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nathan Espinoza</td>
                                            <td>5956</td>
                                            <td>Strathcona County</td>
                                            <td>2002/25/01</td>
                                            <td>47%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kelly Cameron</td>
                                            <td>4836</td>
                                            <td>Fontaine-Valmont</td>
                                            <td>1999/02/07</td>
                                            <td>24%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kyra Moses</td>
                                            <td>3796</td>
                                            <td>Quenast</td>
                                            <td>1998/07/07</td>
                                            <td>68%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Grace Bishop</td>
                                            <td>8340</td>
                                            <td>Rodez</td>
                                            <td>2012/02/10</td>
                                            <td>4%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Haviva Hernandez</td>
                                            <td>8136</td>
                                            <td>Suwałki</td>
                                            <td>2000/30/01</td>
                                            <td>16%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alisa Horn</td>
                                            <td>9853</td>
                                            <td>Ucluelet</td>
                                            <td>2007/01/11</td>
                                            <td>39%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Zelenia Roman</td>
                                            <td>7516</td>
                                            <td>Redwater</td>
                                            <td>2012/03/03</td>
                                            <td>31%</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn">Sửa</button>
                                                <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                                </div>
                                <div class="tab-pane fade" id="qlysk-justified" role="tabpanel" aria-labelledby="qlysk-tab">
                                <!-- Table with stripped rows -->
                                <table class="table datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <b>N</b>ame
                                            </th>
                                            <th>Ext.</th>
                                            <th>City</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                            <th>Completion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Unity Pugh</td>
                                            <td>9958</td>
                                            <td>Curicó</td>
                                            <td>2005/02/11</td>
                                            <td>37%</td>
                                        </tr>
                                        <tr>
                                            <td>Theodore Duran</td>
                                            <td>8971</td>
                                            <td>Dhanbad</td>
                                            <td>1999/04/07</td>
                                            <td>97%</td>
                                        </tr>
                                        <tr>
                                            <td>Kylie Bishop</td>
                                            <td>3147</td>
                                            <td>Norman</td>
                                            <td>2005/09/08</td>
                                            <td>63%</td>
                                        </tr>
                                        <tr>
                                            <td>Willow Gilliam</td>
                                            <td>3497</td>
                                            <td>Amqui</td>
                                            <td>2009/29/11</td>
                                            <td>30%</td>
                                        </tr>
                                        <tr>
                                            <td>Blossom Dickerson</td>
                                            <td>5018</td>
                                            <td>Kempten</td>
                                            <td>2006/11/09</td>
                                            <td>17%</td>
                                        </tr>
                                        <tr>
                                            <td>Elliott Snyder</td>
                                            <td>3925</td>
                                            <td>Enines</td>
                                            <td>2006/03/08</td>
                                            <td>57%</td>
                                        </tr>
                                        <tr>
                                            <td>Castor Pugh</td>
                                            <td>9488</td>
                                            <td>Neath</td>
                                            <td>2014/23/12</td>
                                            <td>93%</td>
                                        </tr>
                                        <tr>
                                            <td>Pearl Carlson</td>
                                            <td>6231</td>
                                            <td>Cobourg</td>
                                            <td>2014/31/08</td>
                                            <td>100%</td>
                                        </tr>
                                        <tr>
                                            <td>Deirdre Bridges</td>
                                            <td>1579</td>
                                            <td>Eberswalde-Finow</td>
                                            <td>2014/26/08</td>
                                            <td>44%</td>
                                        </tr>
                                        <tr>
                                            <td>Daniel Baldwin</td>
                                            <td>6095</td>
                                            <td>Moircy</td>
                                            <td>2000/11/01</td>
                                            <td>33%</td>
                                        </tr>
                                        <tr>
                                            <td>Phelan Kane</td>
                                            <td>9519</td>
                                            <td>Germersheim</td>
                                            <td>1999/16/04</td>
                                            <td>77%</td>
                                        </tr>
                                        <tr>
                                            <td>Quentin Salas</td>
                                            <td>1339</td>
                                            <td>Los Andes</td>
                                            <td>2011/26/01</td>
                                            <td>49%</td>
                                        </tr>
                                        <tr>
                                            <td>Armand Suarez</td>
                                            <td>6583</td>
                                            <td>Funtua</td>
                                            <td>1999/06/11</td>
                                            <td>9%</td>
                                        </tr>
                                        <tr>
                                            <td>Gretchen Rogers</td>
                                            <td>5393</td>
                                            <td>Moxhe</td>
                                            <td>1998/26/10</td>
                                            <td>24%</td>
                                        </tr>
                                        <tr>
                                            <td>Harding Thompson</td>
                                            <td>2824</td>
                                            <td>Abeokuta</td>
                                            <td>2008/06/08</td>
                                            <td>10%</td>
                                        </tr>
                                        <tr>
                                            <td>Mira Rocha</td>
                                            <td>4393</td>
                                            <td>Port Harcourt</td>
                                            <td>2002/04/10</td>
                                            <td>14%</td>
                                        </tr>
                                        <tr>
                                            <td>Drew Phillips</td>
                                            <td>2931</td>
                                            <td>Goes</td>
                                            <td>2011/18/10</td>
                                            <td>58%</td>
                                        </tr>
                                        <tr>
                                            <td>Emerald Warner</td>
                                            <td>6205</td>
                                            <td>Chiavari</td>
                                            <td>2002/08/04</td>
                                            <td>58%</td>
                                        </tr>
                                        <tr>
                                            <td>Colin Burch</td>
                                            <td>7457</td>
                                            <td>Anamur</td>
                                            <td>2004/02/01</td>
                                            <td>34%</td>
                                        </tr>
                                        <tr>
                                            <td>Russell Haynes</td>
                                            <td>8916</td>
                                            <td>Frascati</td>
                                            <td>2015/28/04</td>
                                            <td>18%</td>
                                        </tr>
                                        <tr>
                                            <td>Brennan Brooks</td>
                                            <td>9011</td>
                                            <td>Olmué</td>
                                            <td>2000/18/04</td>
                                            <td>2%</td>
                                        </tr>
                                        <tr>
                                            <td>Kane Anthony</td>
                                            <td>8075</td>
                                            <td>LaSalle</td>
                                            <td>2006/21/05</td>
                                            <td>93%</td>
                                        </tr>
                                        <tr>
                                            <td>Scarlett Hurst</td>
                                            <td>1019</td>
                                            <td>Brampton</td>
                                            <td>2015/07/01</td>
                                            <td>94%</td>
                                        </tr>
                                        <tr>
                                            <td>James Scott</td>
                                            <td>3008</td>
                                            <td>Meux</td>
                                            <td>2007/30/05</td>
                                            <td>55%</td>
                                        </tr>
                                        <tr>
                                            <td>Desiree Ferguson</td>
                                            <td>9054</td>
                                            <td>Gojra</td>
                                            <td>2009/15/02</td>
                                            <td>81%</td>
                                        </tr>
                                        <tr>
                                            <td>Elaine Bishop</td>
                                            <td>9160</td>
                                            <td>Petrópolis</td>
                                            <td>2008/23/12</td>
                                            <td>48%</td>
                                        </tr>
                                        <tr>
                                            <td>Hilda Nelson</td>
                                            <td>6307</td>
                                            <td>Posina</td>
                                            <td>2004/23/05</td>
                                            <td>76%</td>
                                        </tr>
                                        <tr>
                                            <td>Evangeline Beasley</td>
                                            <td>3820</td>
                                            <td>Caplan</td>
                                            <td>2009/12/03</td>
                                            <td>62%</td>
                                        </tr>
                                        <tr>
                                            <td>Wyatt Riley</td>
                                            <td>5694</td>
                                            <td>Cavaion Veronese</td>
                                            <td>2012/19/02</td>
                                            <td>67%</td>
                                        </tr>
                                        <tr>
                                            <td>Wyatt Mccarthy</td>
                                            <td>3547</td>
                                            <td>Patan</td>
                                            <td>2014/23/06</td>
                                            <td>9%</td>
                                        </tr>
                                        <tr>
                                            <td>Cairo Rice</td>
                                            <td>6273</td>
                                            <td>Ostra Vetere</td>
                                            <td>2016/27/02</td>
                                            <td>13%</td>
                                        </tr>
                                        <tr>
                                            <td>Sylvia Peters</td>
                                            <td>6829</td>
                                            <td>Arrah</td>
                                            <td>2015/03/02</td>
                                            <td>13%</td>
                                        </tr>
                                        <tr>
                                            <td>Kasper Craig</td>
                                            <td>5515</td>
                                            <td>Firenze</td>
                                            <td>2015/26/04</td>
                                            <td>56%</td>
                                        </tr>
                                        <tr>
                                            <td>Leigh Ruiz</td>
                                            <td>5112</td>
                                            <td>Lac Ste. Anne</td>
                                            <td>2001/09/02</td>
                                            <td>28%</td>
                                        </tr>
                                        <tr>
                                            <td>Athena Aguirre</td>
                                            <td>5741</td>
                                            <td>Romeral</td>
                                            <td>2010/24/03</td>
                                            <td>15%</td>
                                        </tr>
                                        <tr>
                                            <td>Riley Nunez</td>
                                            <td>5533</td>
                                            <td>Sart-Eustache</td>
                                            <td>2003/26/02</td>
                                            <td>30%</td>
                                        </tr>
                                        <tr>
                                            <td>Lois Talley</td>
                                            <td>9393</td>
                                            <td>Dorchester</td>
                                            <td>2014/05/01</td>
                                            <td>51%</td>
                                        </tr>
                                        <tr>
                                            <td>Hop Bass</td>
                                            <td>1024</td>
                                            <td>Westerlo</td>
                                            <td>2012/25/09</td>
                                            <td>85%</td>
                                        </tr>
                                        <tr>
                                            <td>Kalia Diaz</td>
                                            <td>9184</td>
                                            <td>Ichalkaranji</td>
                                            <td>2013/26/06</td>
                                            <td>92%</td>
                                        </tr>
                                        <tr>
                                            <td>Maia Pate</td>
                                            <td>6682</td>
                                            <td>Louvain-la-Neuve</td>
                                            <td>2011/23/04</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td>Macaulay Pruitt</td>
                                            <td>4457</td>
                                            <td>Fraser-Fort George</td>
                                            <td>2015/03/08</td>
                                            <td>92%</td>
                                        </tr>
                                        <tr>
                                            <td>Danielle Oconnor</td>
                                            <td>9464</td>
                                            <td>Neuwied</td>
                                            <td>2001/05/10</td>
                                            <td>17%</td>
                                        </tr>
                                        <tr>
                                            <td>Kato Carr</td>
                                            <td>4842</td>
                                            <td>Faridabad</td>
                                            <td>2012/11/05</td>
                                            <td>96%</td>
                                        </tr>
                                        <tr>
                                            <td>Malachi Mejia</td>
                                            <td>7133</td>
                                            <td>Vorst</td>
                                            <td>2007/25/04</td>
                                            <td>26%</td>
                                        </tr>
                                        <tr>
                                            <td>Dominic Carver</td>
                                            <td>3476</td>
                                            <td>Pointe-aux-Trembles</td>
                                            <td>2014/14/03</td>
                                            <td>71%</td>
                                        </tr>
                                        <tr>
                                            <td>Paki Santos</td>
                                            <td>4424</td>
                                            <td>Cache Creek</td>
                                            <td>2001/18/11</td>
                                            <td>82%</td>
                                        </tr>
                                        <tr>
                                            <td>Ross Hodges</td>
                                            <td>1862</td>
                                            <td>Trazegnies</td>
                                            <td>2010/19/09</td>
                                            <td>87%</td>
                                        </tr>
                                        <tr>
                                            <td>Hilda Whitley</td>
                                            <td>3514</td>
                                            <td>New Sarepta</td>
                                            <td>2011/05/07</td>
                                            <td>94%</td>
                                        </tr>
                                        <tr>
                                            <td>Roth Cherry</td>
                                            <td>4006</td>
                                            <td>Flin Flon</td>
                                            <td>2008/02/09</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td>Lareina Jones</td>
                                            <td>8642</td>
                                            <td>East Linton</td>
                                            <td>2009/07/08</td>
                                            <td>21%</td>
                                        </tr>
                                        <tr>
                                            <td>Joshua Weiss</td>
                                            <td>2289</td>
                                            <td>Saint-Léonard</td>
                                            <td>2010/15/01</td>
                                            <td>52%</td>
                                        </tr>
                                        <tr>
                                            <td>Kiona Lowery</td>
                                            <td>5952</td>
                                            <td>Inuvik</td>
                                            <td>2002/17/12</td>
                                            <td>72%</td>
                                        </tr>
                                        <tr>
                                            <td>Nina Rush</td>
                                            <td>7567</td>
                                            <td>Bo‘lhe</td>
                                            <td>2008/27/01</td>
                                            <td>6%</td>
                                        </tr>
                                        <tr>
                                            <td>Palmer Parker</td>
                                            <td>2000</td>
                                            <td>Stade</td>
                                            <td>2012/24/07</td>
                                            <td>58%</td>
                                        </tr>
                                        <tr>
                                            <td>Vielka Olsen</td>
                                            <td>3745</td>
                                            <td>Vrasene</td>
                                            <td>2016/08/01</td>
                                            <td>70%</td>
                                        </tr>
                                        <tr>
                                            <td>Meghan Cunningham</td>
                                            <td>8604</td>
                                            <td>Söke</td>
                                            <td>2007/16/02</td>
                                            <td>59%</td>
                                        </tr>
                                        <tr>
                                            <td>Iola Shaw</td>
                                            <td>6447</td>
                                            <td>Albany</td>
                                            <td>2014/05/03</td>
                                            <td>88%</td>
                                        </tr>
                                        <tr>
                                            <td>Imelda Cole</td>
                                            <td>4564</td>
                                            <td>Haasdonk</td>
                                            <td>2007/16/11</td>
                                            <td>79%</td>
                                        </tr>
                                        <tr>
                                            <td>Jerry Beach</td>
                                            <td>6801</td>
                                            <td>Gattatico</td>
                                            <td>1999/07/07</td>
                                            <td>36%</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Rocha</td>
                                            <td>3938</td>
                                            <td>Gavorrano</td>
                                            <td>2000/06/08</td>
                                            <td>71%</td>
                                        </tr>
                                        <tr>
                                            <td>Derek Kerr</td>
                                            <td>1724</td>
                                            <td>Gualdo Cattaneo</td>
                                            <td>2014/21/01</td>
                                            <td>89%</td>
                                        </tr>
                                        <tr>
                                            <td>Shad Hudson</td>
                                            <td>5944</td>
                                            <td>Salamanca</td>
                                            <td>2014/10/12</td>
                                            <td>98%</td>
                                        </tr>
                                        <tr>
                                            <td>Daryl Ayers</td>
                                            <td>8276</td>
                                            <td>Barchi</td>
                                            <td>2012/12/11</td>
                                            <td>88%</td>
                                        </tr>
                                        <tr>
                                            <td>Caleb Livingston</td>
                                            <td>3094</td>
                                            <td>Fatehpur</td>
                                            <td>2014/13/02</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td>Sydney Meyer</td>
                                            <td>4576</td>
                                            <td>Neubrandenburg</td>
                                            <td>2015/06/02</td>
                                            <td>22%</td>
                                        </tr>
                                        <tr>
                                            <td>Lani Lawrence</td>
                                            <td>8501</td>
                                            <td>Turnhout</td>
                                            <td>2008/07/05</td>
                                            <td>16%</td>
                                        </tr>
                                        <tr>
                                            <td>Allegra Shepherd</td>
                                            <td>2576</td>
                                            <td>Meeuwen-Gruitrode</td>
                                            <td>2004/19/04</td>
                                            <td>41%</td>
                                        </tr>
                                        <tr>
                                            <td>Fallon Reyes</td>
                                            <td>3178</td>
                                            <td>Monceau-sur-Sambre</td>
                                            <td>2005/15/02</td>
                                            <td>16%</td>
                                        </tr>
                                        <tr>
                                            <td>Karen Whitley</td>
                                            <td>4357</td>
                                            <td>Sluis</td>
                                            <td>2003/02/05</td>
                                            <td>23%</td>
                                        </tr>
                                        <tr>
                                            <td>Stewart Stephenson</td>
                                            <td>5350</td>
                                            <td>Villa Faraldi</td>
                                            <td>2003/05/07</td>
                                            <td>65%</td>
                                        </tr>
                                        <tr>
                                            <td>Ursula Reynolds</td>
                                            <td>7544</td>
                                            <td>Southampton</td>
                                            <td>1999/16/12</td>
                                            <td>61%</td>
                                        </tr>
                                        <tr>
                                            <td>Adrienne Winters</td>
                                            <td>4425</td>
                                            <td>Laguna Blanca</td>
                                            <td>2014/15/09</td>
                                            <td>24%</td>
                                        </tr>
                                        <tr>
                                            <td>Francesca Brock</td>
                                            <td>1337</td>
                                            <td>Oban</td>
                                            <td>2000/12/06</td>
                                            <td>90%</td>
                                        </tr>
                                        <tr>
                                            <td>Ursa Davenport</td>
                                            <td>7629</td>
                                            <td>New Plymouth</td>
                                            <td>2013/27/06</td>
                                            <td>37%</td>
                                        </tr>
                                        <tr>
                                            <td>Mark Brock</td>
                                            <td>3310</td>
                                            <td>Veenendaal</td>
                                            <td>2006/08/09</td>
                                            <td>41%</td>
                                        </tr>
                                        <tr>
                                            <td>Dale Rush</td>
                                            <td>5050</td>
                                            <td>Chicoutimi</td>
                                            <td>2000/27/03</td>
                                            <td>2%</td>
                                        </tr>
                                        <tr>
                                            <td>Shellie Murphy</td>
                                            <td>3845</td>
                                            <td>Marlborough</td>
                                            <td>2013/13/11</td>
                                            <td>72%</td>
                                        </tr>
                                        <tr>
                                            <td>Porter Nicholson</td>
                                            <td>4539</td>
                                            <td>Bismil</td>
                                            <td>2012/22/10</td>
                                            <td>23%</td>
                                        </tr>
                                        <tr>
                                            <td>Oliver Huber</td>
                                            <td>1265</td>
                                            <td>Hannche</td>
                                            <td>2002/11/01</td>
                                            <td>94%</td>
                                        </tr>
                                        <tr>
                                            <td>Calista Maynard</td>
                                            <td>3315</td>
                                            <td>Pozzuolo del Friuli</td>
                                            <td>2006/23/03</td>
                                            <td>5%</td>
                                        </tr>
                                        <tr>
                                            <td>Lois Vargas</td>
                                            <td>6825</td>
                                            <td>Cumberland</td>
                                            <td>1999/25/04</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td>Hermione Dickson</td>
                                            <td>2785</td>
                                            <td>Woodstock</td>
                                            <td>2001/22/03</td>
                                            <td>2%</td>
                                        </tr>
                                        <tr>
                                            <td>Dalton Jennings</td>
                                            <td>5416</td>
                                            <td>Dudzele</td>
                                            <td>2015/09/02</td>
                                            <td>74%</td>
                                        </tr>
                                        <tr>
                                            <td>Cathleen Kramer</td>
                                            <td>3380</td>
                                            <td>Crowsnest Pass</td>
                                            <td>2012/27/07</td>
                                            <td>53%</td>
                                        </tr>
                                        <tr>
                                            <td>Zachery Morgan</td>
                                            <td>6730</td>
                                            <td>Collines-de-l'Outaouais</td>
                                            <td>2006/04/09</td>
                                            <td>51%</td>
                                        </tr>
                                        <tr>
                                            <td>Yoko Freeman</td>
                                            <td>4077</td>
                                            <td>Lidköping</td>
                                            <td>2002/27/12</td>
                                            <td>48%</td>
                                        </tr>
                                        <tr>
                                            <td>Chaim Waller</td>
                                            <td>4240</td>
                                            <td>North Shore</td>
                                            <td>2010/25/07</td>
                                            <td>25%</td>
                                        </tr>
                                        <tr>
                                            <td>Berk Johnston</td>
                                            <td>4532</td>
                                            <td>Vergnies</td>
                                            <td>2016/23/02</td>
                                            <td>93%</td>
                                        </tr>
                                        <tr>
                                            <td>Tad Munoz</td>
                                            <td>2902</td>
                                            <td>Saint-Nazaire</td>
                                            <td>2010/09/05</td>
                                            <td>65%</td>
                                        </tr>
                                        <tr>
                                            <td>Vivien Dominguez</td>
                                            <td>5653</td>
                                            <td>Bargagli</td>
                                            <td>2001/09/01</td>
                                            <td>86%</td>
                                        </tr>
                                        <tr>
                                            <td>Carissa Lara</td>
                                            <td>3241</td>
                                            <td>Sherborne</td>
                                            <td>2015/07/12</td>
                                            <td>72%</td>
                                        </tr>
                                        <tr>
                                            <td>Hammett Gordon</td>
                                            <td>8101</td>
                                            <td>Wah</td>
                                            <td>1998/06/09</td>
                                            <td>20%</td>
                                        </tr>
                                        <tr>
                                            <td>Walker Nixon</td>
                                            <td>6901</td>
                                            <td>Metz</td>
                                            <td>2011/12/11</td>
                                            <td>41%</td>
                                        </tr>
                                        <tr>
                                            <td>Nathan Espinoza</td>
                                            <td>5956</td>
                                            <td>Strathcona County</td>
                                            <td>2002/25/01</td>
                                            <td>47%</td>
                                        </tr>
                                        <tr>
                                            <td>Kelly Cameron</td>
                                            <td>4836</td>
                                            <td>Fontaine-Valmont</td>
                                            <td>1999/02/07</td>
                                            <td>24%</td>
                                        </tr>
                                        <tr>
                                            <td>Kyra Moses</td>
                                            <td>3796</td>
                                            <td>Quenast</td>
                                            <td>1998/07/07</td>
                                            <td>68%</td>
                                        </tr>
                                        <tr>
                                            <td>Grace Bishop</td>
                                            <td>8340</td>
                                            <td>Rodez</td>
                                            <td>2012/02/10</td>
                                            <td>4%</td>
                                        </tr>
                                        <tr>
                                            <td>Haviva Hernandez</td>
                                            <td>8136</td>
                                            <td>Suwałki</td>
                                            <td>2000/30/01</td>
                                            <td>16%</td>
                                        </tr>
                                        <tr>
                                            <td>Alisa Horn</td>
                                            <td>9853</td>
                                            <td>Ucluelet</td>
                                            <td>2007/01/11</td>
                                            <td>39%</td>
                                        </tr>
                                        <tr>
                                            <td>Zelenia Roman</td>
                                            <td>7516</td>
                                            <td>Redwater</td>
                                            <td>2012/03/03</td>
                                            <td>31%</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                                </div>
                                <div class="tab-pane fade" id="qlythucan-justified" role="tabpanel" aria-labelledby="qlythucan-tab">
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <b>N</b>ame
                                                </th>
                                                <th>Ext.</th>
                                                <th>City</th>
                                                <th>Completion</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Unity Pugh</td>
                                                <td>9958</td>
                                                <td>Curicó</td>
                                                <td>2005/02/11</td>
                                                <td>37%</td>
                                            </tr>
                                            <tr>
                                                <td>Theodore Duran</td>
                                                <td>8971</td>
                                                <td>Dhanbad</td>
                                                <td>1999/04/07</td>
                                                <td>97%</td>
                                            </tr>
                                            <tr>
                                                <td>Kylie Bishop</td>
                                                <td>3147</td>
                                                <td>Norman</td>
                                                <td>2005/09/08</td>
                                                <td>63%</td>
                                            </tr>
                                            <tr>
                                                <td>Willow Gilliam</td>
                                                <td>3497</td>
                                                <td>Amqui</td>
                                                <td>2009/29/11</td>
                                                <td>30%</td>
                                            </tr>
                                            <tr>
                                                <td>Blossom Dickerson</td>
                                                <td>5018</td>
                                                <td>Kempten</td>
                                                <td>2006/11/09</td>
                                                <td>17%</td>
                                            </tr>
                                            <tr>
                                                <td>Elliott Snyder</td>
                                                <td>3925</td>
                                                <td>Enines</td>
                                                <td>2006/03/08</td>
                                                <td>57%</td>
                                            </tr>
                                            <tr>
                                                <td>Castor Pugh</td>
                                                <td>9488</td>
                                                <td>Neath</td>
                                                <td>2014/23/12</td>
                                                <td>93%</td>
                                            </tr>
                                            <tr>
                                                <td>Pearl Carlson</td>
                                                <td>6231</td>
                                                <td>Cobourg</td>
                                                <td>2014/31/08</td>
                                                <td>100%</td>
                                            </tr>
                                            <tr>
                                                <td>Deirdre Bridges</td>
                                                <td>1579</td>
                                                <td>Eberswalde-Finow</td>
                                                <td>2014/26/08</td>
                                                <td>44%</td>
                                            </tr>
                                            <tr>
                                                <td>Daniel Baldwin</td>
                                                <td>6095</td>
                                                <td>Moircy</td>
                                                <td>2000/11/01</td>
                                                <td>33%</td>
                                            </tr>
                                            <tr>
                                                <td>Phelan Kane</td>
                                                <td>9519</td>
                                                <td>Germersheim</td>
                                                <td>1999/16/04</td>
                                                <td>77%</td>
                                            </tr>
                                            <tr>
                                                <td>Quentin Salas</td>
                                                <td>1339</td>
                                                <td>Los Andes</td>
                                                <td>2011/26/01</td>
                                                <td>49%</td>
                                            </tr>
                                            <tr>
                                                <td>Armand Suarez</td>
                                                <td>6583</td>
                                                <td>Funtua</td>
                                                <td>1999/06/11</td>
                                                <td>9%</td>
                                            </tr>
                                            <tr>
                                                <td>Gretchen Rogers</td>
                                                <td>5393</td>
                                                <td>Moxhe</td>
                                                <td>1998/26/10</td>
                                                <td>24%</td>
                                            </tr>
                                            <tr>
                                                <td>Harding Thompson</td>
                                                <td>2824</td>
                                                <td>Abeokuta</td>
                                                <td>2008/06/08</td>
                                                <td>10%</td>
                                            </tr>
                                            <tr>
                                                <td>Mira Rocha</td>
                                                <td>4393</td>
                                                <td>Port Harcourt</td>
                                                <td>2002/04/10</td>
                                                <td>14%</td>
                                            </tr>
                                            <tr>
                                                <td>Drew Phillips</td>
                                                <td>2931</td>
                                                <td>Goes</td>
                                                <td>2011/18/10</td>
                                                <td>58%</td>
                                            </tr>
                                            <tr>
                                                <td>Emerald Warner</td>
                                                <td>6205</td>
                                                <td>Chiavari</td>
                                                <td>2002/08/04</td>
                                                <td>58%</td>
                                            </tr>
                                            <tr>
                                                <td>Colin Burch</td>
                                                <td>7457</td>
                                                <td>Anamur</td>
                                                <td>2004/02/01</td>
                                                <td>34%</td>
                                            </tr>
                                            <tr>
                                                <td>Russell Haynes</td>
                                                <td>8916</td>
                                                <td>Frascati</td>
                                                <td>2015/28/04</td>
                                                <td>18%</td>
                                            </tr>
                                            <tr>
                                                <td>Brennan Brooks</td>
                                                <td>9011</td>
                                                <td>Olmué</td>
                                                <td>2000/18/04</td>
                                                <td>2%</td>
                                            </tr>
                                            <tr>
                                                <td>Kane Anthony</td>
                                                <td>8075</td>
                                                <td>LaSalle</td>
                                                <td>2006/21/05</td>
                                                <td>93%</td>
                                            </tr>
                                            <tr>
                                                <td>Scarlett Hurst</td>
                                                <td>1019</td>
                                                <td>Brampton</td>
                                                <td>2015/07/01</td>
                                                <td>94%</td>
                                            </tr>
                                            <tr>
                                                <td>James Scott</td>
                                                <td>3008</td>
                                                <td>Meux</td>
                                                <td>2007/30/05</td>
                                                <td>55%</td>
                                            </tr>
                                            <tr>
                                                <td>Desiree Ferguson</td>
                                                <td>9054</td>
                                                <td>Gojra</td>
                                                <td>2009/15/02</td>
                                                <td>81%</td>
                                            </tr>
                                            <tr>
                                                <td>Elaine Bishop</td>
                                                <td>9160</td>
                                                <td>Petrópolis</td>
                                                <td>2008/23/12</td>
                                                <td>48%</td>
                                            </tr>
                                            <tr>
                                                <td>Hilda Nelson</td>
                                                <td>6307</td>
                                                <td>Posina</td>
                                                <td>2004/23/05</td>
                                                <td>76%</td>
                                            </tr>
                                            <tr>
                                                <td>Evangeline Beasley</td>
                                                <td>3820</td>
                                                <td>Caplan</td>
                                                <td>2009/12/03</td>
                                                <td>62%</td>
                                            </tr>
                                            <tr>
                                                <td>Wyatt Riley</td>
                                                <td>5694</td>
                                                <td>Cavaion Veronese</td>
                                                <td>2012/19/02</td>
                                                <td>67%</td>
                                            </tr>
                                            <tr>
                                                <td>Wyatt Mccarthy</td>
                                                <td>3547</td>
                                                <td>Patan</td>
                                                <td>2014/23/06</td>
                                                <td>9%</td>
                                            </tr>
                                            <tr>
                                                <td>Cairo Rice</td>
                                                <td>6273</td>
                                                <td>Ostra Vetere</td>
                                                <td>2016/27/02</td>
                                                <td>13%</td>
                                            </tr>
                                            <tr>
                                                <td>Sylvia Peters</td>
                                                <td>6829</td>
                                                <td>Arrah</td>
                                                <td>2015/03/02</td>
                                                <td>13%</td>
                                            </tr>
                                            <tr>
                                                <td>Kasper Craig</td>
                                                <td>5515</td>
                                                <td>Firenze</td>
                                                <td>2015/26/04</td>
                                                <td>56%</td>
                                            </tr>
                                            <tr>
                                                <td>Leigh Ruiz</td>
                                                <td>5112</td>
                                                <td>Lac Ste. Anne</td>
                                                <td>2001/09/02</td>
                                                <td>28%</td>
                                            </tr>
                                            <tr>
                                                <td>Athena Aguirre</td>
                                                <td>5741</td>
                                                <td>Romeral</td>
                                                <td>2010/24/03</td>
                                                <td>15%</td>
                                            </tr>
                                            <tr>
                                                <td>Riley Nunez</td>
                                                <td>5533</td>
                                                <td>Sart-Eustache</td>
                                                <td>2003/26/02</td>
                                                <td>30%</td>
                                            </tr>
                                            <tr>
                                                <td>Lois Talley</td>
                                                <td>9393</td>
                                                <td>Dorchester</td>
                                                <td>2014/05/01</td>
                                                <td>51%</td>
                                            </tr>
                                            <tr>
                                                <td>Hop Bass</td>
                                                <td>1024</td>
                                                <td>Westerlo</td>
                                                <td>2012/25/09</td>
                                                <td>85%</td>
                                            </tr>
                                            <tr>
                                                <td>Kalia Diaz</td>
                                                <td>9184</td>
                                                <td>Ichalkaranji</td>
                                                <td>2013/26/06</td>
                                                <td>92%</td>
                                            </tr>
                                            <tr>
                                                <td>Maia Pate</td>
                                                <td>6682</td>
                                                <td>Louvain-la-Neuve</td>
                                                <td>2011/23/04</td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td>Macaulay Pruitt</td>
                                                <td>4457</td>
                                                <td>Fraser-Fort George</td>
                                                <td>2015/03/08</td>
                                                <td>92%</td>
                                            </tr>
                                            <tr>
                                                <td>Danielle Oconnor</td>
                                                <td>9464</td>
                                                <td>Neuwied</td>
                                                <td>2001/05/10</td>
                                                <td>17%</td>
                                            </tr>
                                            <tr>
                                                <td>Kato Carr</td>
                                                <td>4842</td>
                                                <td>Faridabad</td>
                                                <td>2012/11/05</td>
                                                <td>96%</td>
                                            </tr>
                                            <tr>
                                                <td>Malachi Mejia</td>
                                                <td>7133</td>
                                                <td>Vorst</td>
                                                <td>2007/25/04</td>
                                                <td>26%</td>
                                            </tr>
                                            <tr>
                                                <td>Dominic Carver</td>
                                                <td>3476</td>
                                                <td>Pointe-aux-Trembles</td>
                                                <td>2014/14/03</td>
                                                <td>71%</td>
                                            </tr>
                                            <tr>
                                                <td>Paki Santos</td>
                                                <td>4424</td>
                                                <td>Cache Creek</td>
                                                <td>2001/18/11</td>
                                                <td>82%</td>
                                            </tr>
                                            <tr>
                                                <td>Ross Hodges</td>
                                                <td>1862</td>
                                                <td>Trazegnies</td>
                                                <td>2010/19/09</td>
                                                <td>87%</td>
                                            </tr>
                                            <tr>
                                                <td>Hilda Whitley</td>
                                                <td>3514</td>
                                                <td>New Sarepta</td>
                                                <td>2011/05/07</td>
                                                <td>94%</td>
                                            </tr>
                                            <tr>
                                                <td>Roth Cherry</td>
                                                <td>4006</td>
                                                <td>Flin Flon</td>
                                                <td>2008/02/09</td>
                                                <td>8%</td>
                                            </tr>
                                            <tr>
                                                <td>Lareina Jones</td>
                                                <td>8642</td>
                                                <td>East Linton</td>
                                                <td>2009/07/08</td>
                                                <td>21%</td>
                                            </tr>
                                            <tr>
                                                <td>Joshua Weiss</td>
                                                <td>2289</td>
                                                <td>Saint-Léonard</td>
                                                <td>2010/15/01</td>
                                                <td>52%</td>
                                            </tr>
                                            <tr>
                                                <td>Kiona Lowery</td>
                                                <td>5952</td>
                                                <td>Inuvik</td>
                                                <td>2002/17/12</td>
                                                <td>72%</td>
                                            </tr>
                                            <tr>
                                                <td>Nina Rush</td>
                                                <td>7567</td>
                                                <td>Bo‘lhe</td>
                                                <td>2008/27/01</td>
                                                <td>6%</td>
                                            </tr>
                                            <tr>
                                                <td>Palmer Parker</td>
                                                <td>2000</td>
                                                <td>Stade</td>
                                                <td>2012/24/07</td>
                                                <td>58%</td>
                                            </tr>
                                            <tr>
                                                <td>Vielka Olsen</td>
                                                <td>3745</td>
                                                <td>Vrasene</td>
                                                <td>2016/08/01</td>
                                                <td>70%</td>
                                            </tr>
                                            <tr>
                                                <td>Meghan Cunningham</td>
                                                <td>8604</td>
                                                <td>Söke</td>
                                                <td>2007/16/02</td>
                                                <td>59%</td>
                                            </tr>
                                            <tr>
                                                <td>Iola Shaw</td>
                                                <td>6447</td>
                                                <td>Albany</td>
                                                <td>2014/05/03</td>
                                                <td>88%</td>
                                            </tr>
                                            <tr>
                                                <td>Imelda Cole</td>
                                                <td>4564</td>
                                                <td>Haasdonk</td>
                                                <td>2007/16/11</td>
                                                <td>79%</td>
                                            </tr>
                                            <tr>
                                                <td>Jerry Beach</td>
                                                <td>6801</td>
                                                <td>Gattatico</td>
                                                <td>1999/07/07</td>
                                                <td>36%</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Rocha</td>
                                                <td>3938</td>
                                                <td>Gavorrano</td>
                                                <td>2000/06/08</td>
                                                <td>71%</td>
                                            </tr>
                                            <tr>
                                                <td>Derek Kerr</td>
                                                <td>1724</td>
                                                <td>Gualdo Cattaneo</td>
                                                <td>2014/21/01</td>
                                                <td>89%</td>
                                            </tr>
                                            <tr>
                                                <td>Shad Hudson</td>
                                                <td>5944</td>
                                                <td>Salamanca</td>
                                                <td>2014/10/12</td>
                                                <td>98%</td>
                                            </tr>
                                            <tr>
                                                <td>Daryl Ayers</td>
                                                <td>8276</td>
                                                <td>Barchi</td>
                                                <td>2012/12/11</td>
                                                <td>88%</td>
                                            </tr>
                                            <tr>
                                                <td>Caleb Livingston</td>
                                                <td>3094</td>
                                                <td>Fatehpur</td>
                                                <td>2014/13/02</td>
                                                <td>8%</td>
                                            </tr>
                                            <tr>
                                                <td>Sydney Meyer</td>
                                                <td>4576</td>
                                                <td>Neubrandenburg</td>
                                                <td>2015/06/02</td>
                                                <td>22%</td>
                                            </tr>
                                            <tr>
                                                <td>Lani Lawrence</td>
                                                <td>8501</td>
                                                <td>Turnhout</td>
                                                <td>2008/07/05</td>
                                                <td>16%</td>
                                            </tr>
                                            <tr>
                                                <td>Allegra Shepherd</td>
                                                <td>2576</td>
                                                <td>Meeuwen-Gruitrode</td>
                                                <td>2004/19/04</td>
                                                <td>41%</td>
                                            </tr>
                                            <tr>
                                                <td>Fallon Reyes</td>
                                                <td>3178</td>
                                                <td>Monceau-sur-Sambre</td>
                                                <td>2005/15/02</td>
                                                <td>16%</td>
                                            </tr>
                                            <tr>
                                                <td>Karen Whitley</td>
                                                <td>4357</td>
                                                <td>Sluis</td>
                                                <td>2003/02/05</td>
                                                <td>23%</td>
                                            </tr>
                                            <tr>
                                                <td>Stewart Stephenson</td>
                                                <td>5350</td>
                                                <td>Villa Faraldi</td>
                                                <td>2003/05/07</td>
                                                <td>65%</td>
                                            </tr>
                                            <tr>
                                                <td>Ursula Reynolds</td>
                                                <td>7544</td>
                                                <td>Southampton</td>
                                                <td>1999/16/12</td>
                                                <td>61%</td>
                                            </tr>
                                            <tr>
                                                <td>Adrienne Winters</td>
                                                <td>4425</td>
                                                <td>Laguna Blanca</td>
                                                <td>2014/15/09</td>
                                                <td>24%</td>
                                            </tr>
                                            <tr>
                                                <td>Francesca Brock</td>
                                                <td>1337</td>
                                                <td>Oban</td>
                                                <td>2000/12/06</td>
                                                <td>90%</td>
                                            </tr>
                                            <tr>
                                                <td>Ursa Davenport</td>
                                                <td>7629</td>
                                                <td>New Plymouth</td>
                                                <td>2013/27/06</td>
                                                <td>37%</td>
                                            </tr>
                                            <tr>
                                                <td>Mark Brock</td>
                                                <td>3310</td>
                                                <td>Veenendaal</td>
                                                <td>2006/08/09</td>
                                                <td>41%</td>
                                            </tr>
                                            <tr>
                                                <td>Dale Rush</td>
                                                <td>5050</td>
                                                <td>Chicoutimi</td>
                                                <td>2000/27/03</td>
                                                <td>2%</td>
                                            </tr>
                                            <tr>
                                                <td>Shellie Murphy</td>
                                                <td>3845</td>
                                                <td>Marlborough</td>
                                                <td>2013/13/11</td>
                                                <td>72%</td>
                                            </tr>
                                            <tr>
                                                <td>Porter Nicholson</td>
                                                <td>4539</td>
                                                <td>Bismil</td>
                                                <td>2012/22/10</td>
                                                <td>23%</td>
                                            </tr>
                                            <tr>
                                                <td>Oliver Huber</td>
                                                <td>1265</td>
                                                <td>Hannche</td>
                                                <td>2002/11/01</td>
                                                <td>94%</td>
                                            </tr>
                                            <tr>
                                                <td>Calista Maynard</td>
                                                <td>3315</td>
                                                <td>Pozzuolo del Friuli</td>
                                                <td>2006/23/03</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Lois Vargas</td>
                                                <td>6825</td>
                                                <td>Cumberland</td>
                                                <td>1999/25/04</td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td>Hermione Dickson</td>
                                                <td>2785</td>
                                                <td>Woodstock</td>
                                                <td>2001/22/03</td>
                                                <td>2%</td>
                                            </tr>
                                            <tr>
                                                <td>Dalton Jennings</td>
                                                <td>5416</td>
                                                <td>Dudzele</td>
                                                <td>2015/09/02</td>
                                                <td>74%</td>
                                            </tr>
                                            <tr>
                                                <td>Cathleen Kramer</td>
                                                <td>3380</td>
                                                <td>Crowsnest Pass</td>
                                                <td>2012/27/07</td>
                                                <td>53%</td>
                                            </tr>
                                            <tr>
                                                <td>Zachery Morgan</td>
                                                <td>6730</td>
                                                <td>Collines-de-l'Outaouais</td>
                                                <td>2006/04/09</td>
                                                <td>51%</td>
                                            </tr>
                                            <tr>
                                                <td>Yoko Freeman</td>
                                                <td>4077</td>
                                                <td>Lidköping</td>
                                                <td>2002/27/12</td>
                                                <td>48%</td>
                                            </tr>
                                            <tr>
                                                <td>Chaim Waller</td>
                                                <td>4240</td>
                                                <td>North Shore</td>
                                                <td>2010/25/07</td>
                                                <td>25%</td>
                                            </tr>
                                            <tr>
                                                <td>Berk Johnston</td>
                                                <td>4532</td>
                                                <td>Vergnies</td>
                                                <td>2016/23/02</td>
                                                <td>93%</td>
                                            </tr>
                                            <tr>
                                                <td>Tad Munoz</td>
                                                <td>2902</td>
                                                <td>Saint-Nazaire</td>
                                                <td>2010/09/05</td>
                                                <td>65%</td>
                                            </tr>
                                            <tr>
                                                <td>Vivien Dominguez</td>
                                                <td>5653</td>
                                                <td>Bargagli</td>
                                                <td>2001/09/01</td>
                                                <td>86%</td>
                                            </tr>
                                            <tr>
                                                <td>Carissa Lara</td>
                                                <td>3241</td>
                                                <td>Sherborne</td>
                                                <td>2015/07/12</td>
                                                <td>72%</td>
                                            </tr>
                                            <tr>
                                                <td>Hammett Gordon</td>
                                                <td>8101</td>
                                                <td>Wah</td>
                                                <td>1998/06/09</td>
                                                <td>20%</td>
                                            </tr>
                                            <tr>
                                                <td>Walker Nixon</td>
                                                <td>6901</td>
                                                <td>Metz</td>
                                                <td>2011/12/11</td>
                                                <td>41%</td>
                                            </tr>
                                            <tr>
                                                <td>Nathan Espinoza</td>
                                                <td>5956</td>
                                                <td>Strathcona County</td>
                                                <td>2002/25/01</td>
                                                <td>47%</td>
                                            </tr>
                                            <tr>
                                                <td>Kelly Cameron</td>
                                                <td>4836</td>
                                                <td>Fontaine-Valmont</td>
                                                <td>1999/02/07</td>
                                                <td>24%</td>
                                            </tr>
                                            <tr>
                                                <td>Kyra Moses</td>
                                                <td>3796</td>
                                                <td>Quenast</td>
                                                <td>1998/07/07</td>
                                                <td>68%</td>
                                            </tr>
                                            <tr>
                                                <td>Grace Bishop</td>
                                                <td>8340</td>
                                                <td>Rodez</td>
                                                <td>2012/02/10</td>
                                                <td>4%</td>
                                            </tr>
                                            <tr>
                                                <td>Haviva Hernandez</td>
                                                <td>8136</td>
                                                <td>Suwałki</td>
                                                <td>2000/30/01</td>
                                                <td>16%</td>
                                            </tr>
                                            <tr>
                                                <td>Alisa Horn</td>
                                                <td>9853</td>
                                                <td>Ucluelet</td>
                                                <td>2007/01/11</td>
                                                <td>39%</td>
                                            </tr>
                                            <tr>
                                                <td>Zelenia Roman</td>
                                                <td>7516</td>
                                                <td>Redwater</td>
                                                <td>2012/03/03</td>
                                                <td>31%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div><!-- End Default Tabs -->
                    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


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
    <!-- Tải jQuery trước -->
    <script src="assets/js/jquery.min.js"></script>
    
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>
