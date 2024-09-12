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

// Giả sử các biến đã được lấy từ cơ sở dữ liệu như sau
$name = $name ?? 'NULL';
$job = $job ?? 'NULL';
$country = $country ?? 'NULL';
$address = $address ?? 'NULL';
$phone = $phone ?? 'NULL';
$email = $email ?? 'NULL';
$company = $company ?? 'NULL';

// Lấy thông tin từ database dựa vào tên đăng nhập từ session
$username = $_SESSION['username'];
$sql = "SELECT name, job, country, address, phone, email, company FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($name, $job, $country, $address, $phone, $email, $company);
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
                <i class="fa-solid fa-database"></i><span>Cơ sở dữ liệu</span><i class="bi bi-chevron-down ms-auto"></i>
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
            <a class="nav-link collapsed" href="trangtrai.php">
                <i class="fa-solid fa-shrimp"></i>
                <span>Trang trại</span>
            </a>
        </li><!-- End trang trại Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ungdung-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-microchip"></i><span>Ứng dụng AI</span><i class="bi bi-chevron-down ms-auto"></i>
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
            <a class="nav-link" href="profile.php">
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


        <!-- ======= main ======= -->
    <main id="main" class="main">
    
        <div class="pagetitle">
            <h1>Hồ sơ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Hồ sơ</li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
    
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
    
                            <img src="assets/img/logo.png" alt="Profile" class="rounded-circle">
                            <h2> <?php echo htmlspecialchars($name); ?></h2>
                            
                        </div>
                    </div>
    
                </div>
    
                <div class="col-xl-8">
    
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
    
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Tổng quan</button>
                                </li>
    
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Sửa thông tin</button>
                                </li>
    
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Cài đặt</button>
                                </li>
    
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Đổi mật khẩu</button>
                                </li>
    
                            </ul>
                            <div class="tab-content pt-2">
    
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
    
                                    <h5 class="card-title">Thông tin chi tiết</h5>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                                        <div class="col-lg-9 col-md-8"> <?php echo htmlspecialchars($name); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Công ty</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($company ? $company : 'NULL'); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nghề nghiệp</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($job ? $job : 'NULL'); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Quốc gia</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($country ? $country : 'NULL'); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($address ? $address : 'NULL'); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($phone ? $phone : 'NULL'); ?></div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($email ? $email : 'NULL'); ?></div>
                                    </div>
    
                                </div>
    
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
    
                                    <!-- Sửa Thông tin Form -->
                                    <form method="POST" action="update_profile.php">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh hồ sơ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/img/logo.png" alt="Profile">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ và tên</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($name); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Công ty</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars(isset($company) ? $company : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Nghề nghiệp</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control" id="Job" value="<?php echo htmlspecialchars(isset($job) ? $job : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Quốc gia</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control" id="Country" value="<?php echo htmlspecialchars(isset($country) ? $country : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address" value="<?php echo htmlspecialchars(isset($address) ? $address : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo htmlspecialchars(isset($phone) ? $phone : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="<?php echo htmlspecialchars(isset($email) ? $email : 'NULL'); ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                        </div>
                                    </form>
    
                                </div>
    
                                <div class="tab-pane fade pt-3" id="profile-settings">
    
                                    <!-- Settings Form -->
                                    <form>
    
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Thông báo email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Thay đổi được thực hiện cho tài khoản của bạn
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Thông tin về dự án và dịch vụ mới
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Tiếp thị và khuyến mãi
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify"
                                                        checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Cảnh báo bảo mật
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->
    
                                </div>
    
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form id="changePasswordForm">
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu cũ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" name="currentPassword" class="form-control" id="currentPassword" required>
                                                <div id="current-password-error" class="invalid-feedback" style="display: none;">
                                                    Mật khẩu không đúng!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu mới</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" name="newpassword" class="form-control" id="newpassword" required>
                                                <div id="invalid-feedback" class="invalid-feedback" style="display: none;">
                                                    Vui lòng nhập mật khẩu!
                                                </div>
                                                <div id="password-requirements" class="invalid-feedback" style="display: none;">
                                                    Mật khẩu phải có tối thiểu 8 ký tự, bao gồm chữ cái in thường, chữ cái in hoa, và số.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                                                <div id="renew-password-error" class="text-danger" style="display: none;">Mật khẩu không khớp!</div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
                                        </div>

                                        <div id="message" class="mt-3 text-center"></div>
                                    </form>
                                   
                            </div><!-- End Bordered Tabs -->
    
                        </div>
                    </div>
    
                </div>
            </div>
        </section>
        
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        // Xử lý submit form thay đổi mật khẩu
        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn form submit mặc định

            $.ajax({
                type: 'POST',
                url: 'change_password.php', // File PHP xử lý cả thay đổi và kiểm tra mật khẩu
                data: $(this).serialize() + '&action=changePassword', // Thêm action để phân biệt yêu cầu
                success: function(response) {
                    $('#message').html(response); // Hiển thị thông báo từ PHP trong div #message
                },
                error: function() {
                    $('#message').html('Có lỗi xảy ra, vui lòng thử lại.'); // Thông báo lỗi khi AJAX thất bại
                }
            });
        });

        // Kiểm tra yêu cầu mật khẩu mới
        $('#newpassword').on('input', function () {
            var inputField = $(this);
            var value = inputField.val();
            var invalidFeedback = $('#invalid-feedback');
            var passwordRequirements = $('#password-requirements');

            // Kiểm tra mật khẩu
            var hasLowercase = /[a-z]/.test(value);
            var hasUppercase = /[A-Z]/.test(value);
            var hasNumber = /[0-9]/.test(value);
            var isValidLength = value.length >= 8;

            if (value === '') {
                // Trường trống
                invalidFeedback.show().text("Vui lòng nhập mật khẩu!");
                passwordRequirements.hide();
                inputField[0].setCustomValidity("Vui lòng nhập mật khẩu!");
            } else if (!isValidLength || !hasLowercase || !hasUppercase || !hasNumber) {
                // Mật khẩu không hợp lệ
                invalidFeedback.hide();
                passwordRequirements.show();
                inputField[0].setCustomValidity("Mật khẩu không hợp lệ!");
            } else {
                // Mật khẩu hợp lệ
                invalidFeedback.hide();
                passwordRequirements.hide();
                inputField[0].setCustomValidity("");
            }

            inputField[0].reportValidity();
        });

        // Xử lý kiểm tra mật khẩu cũ
        $('#currentPassword').on('blur', function () {
            var currentPassword = $(this).val();
            var errorFeedback = $('#current-password-error');

            if (currentPassword !== '') {
                // Gửi yêu cầu AJAX để kiểm tra mật khẩu cũ
                $.ajax({
                    type: 'POST',
                    url: 'change_password.php', // Sử dụng cùng file PHP đã gộp
                    data: { currentPassword: currentPassword, action: 'checkCurrentPassword' }, // Thêm action để phân biệt yêu cầu
                    success: function(response) {
                        if (response.trim() === 'invalid') {
                            // Nếu mật khẩu không đúng, hiển thị thông báo lỗi
                            errorFeedback.show().text("Mật khẩu không đúng!");
                            $('#currentPassword')[0].setCustomValidity("Mật khẩu không đúng!");
                        } else {
                            // Nếu mật khẩu đúng, ẩn thông báo lỗi
                            errorFeedback.hide();
                            $('#currentPassword')[0].setCustomValidity("");
                        }
                        $('#currentPassword')[0].reportValidity();
                    },
                    error: function() {
                        errorFeedback.show().text("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                });
            } else {
                errorFeedback.hide();
                $('#currentPassword')[0].setCustomValidity("");
            }
        });

        // Kiểm tra khớp giữa mật khẩu mới và xác nhận mật khẩu
        $('#renewPassword').on('input', function () {
            var newPassword = $('#newpassword').val();
            var renewPassword = $(this).val();
            var errorFeedback = $('#renew-password-error');

            if (renewPassword !== newPassword) {
                // Nếu mật khẩu không khớp
                errorFeedback.show().text("Mật khẩu không khớp!");
                $(this)[0].setCustomValidity("Mật khẩu không khớp!");
            } else {
                // Nếu mật khẩu khớp
                errorFeedback.hide();
                $(this)[0].setCustomValidity("");
            }
            $(this)[0].reportValidity();
        });
    });
    </script>
        
    </body>

</html>