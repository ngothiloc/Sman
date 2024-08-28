<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay bằng tên người dùng cơ sở dữ liệu của bạn
$password = ""; // Thay bằng mật khẩu cơ sở dữ liệu của bạn
$dbname = "sdb"; // Thay bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xác định số lượng kết quả mỗi trang
$results_per_page = 4; 

// Lấy tổng số kết quả trong cơ sở dữ liệu
$sql = "SELECT * FROM news";
$result = $conn->query($sql);
$number_of_results = $result->num_rows;

// Tính tổng số trang có sẵn
$number_of_pages = ceil($number_of_results / $results_per_page);

// Xác định số trang hiện tại mà người dùng đang truy cập
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Đảm bảo trang không nhỏ hơn 1
if ($page > $number_of_pages) $page = $number_of_pages; // Đảm bảo trang không lớn hơn tổng số trang

// Xác định số bắt đầu cho truy vấn LIMIT để hiển thị kết quả trên trang hiện tại
$start_limit = ($page - 1) * $results_per_page;

// Lấy kết quả được sắp xếp theo ID từ lớn nhất đến nhỏ nhất
$sql = "SELECT * FROM news ORDER BY id DESC LIMIT $start_limit, $results_per_page";
$result = $conn->query($sql);
// Lấy tin tức có ID lớn nhất
$sql_featured = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
$result_featured = $conn->query($sql_featured);
$featured_news = $result_featured->fetch_assoc();

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
            <a href="trangchu.html" class="logo d-flex align-items-center">
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
                        <span class="d-none d-md-block dropdown-toggle ps-2">Ngô Tiến Lộc</span>
                    </a><!-- End Profile Iamge Icon -->
    
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Ngô Tiến Lộc</h6>
                            <span>Nghề nghiệp làm gì đó</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
    
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.html">
                                <i class="bi bi-person"></i>
                                <span>Hồ sơ</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
    
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Chỉnh sửa thông tin</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
    
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
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
                <a class="nav-link collapsed" href="trangchu.html">
                    <i class="fa-solid fa-house"></i>
                    <span>Trang chủ</span>
                </a>
            </li><!-- End Trang chủ Nav -->
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="gioithieu.html">
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
                        <a href="baibao-quocte.html">
                            <i class="bi bi-circle"></i><span>Bài báo quốc tế</span>
                        </a>
                    </li>
                    <li>
                        <a href="baibao-trongnuoc.html">
                            <i class="bi bi-circle"></i><span>Bài báo trong nước</span>
                        </a>
                    </li>
                    <li>
                        <a href="donggop-dulieu.html">
                            <i class="bi bi-circle"></i><span>Đóng góp dữ liệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="lsdonggop-thanhtoan.html">
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
                        <a href="danhsach-benh.php" class="active">
                            <i class="bi bi-circle"></i><span>Danh sách bệnh</span>
                        </a>
                    </li>
                    <li>
                        <a href="chuandoan.html">
                            <i class="bi bi-circle"></i><span>Chuẩn đoán bệnh</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End bệnh thuỷ sản Nav -->
    
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#csdl-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-database"></i><span>Cơ sở dữ liệu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="csdl-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="dulieu-nuoc.html">
                            <i class="bi bi-circle"></i><span>Dữ liệu chất lượng nước</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-khihau.html">
                            <i class="bi bi-circle"></i><span>Dữ liệu vi khí hậu, thời tiết vùng nuôi</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-domtrang.html" class="active">
                            <i class="bi bi-circle"></i><span>Dữ liệu bệnh đốm trắng</span>
                        </a>
                    </li>
                    <li>
                        <a href="dulieu-gan.html">
                            <i class="bi bi-circle"></i><span>Dữ liệu bệnh hoại tử gan tuỵ cấp</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Cơ sở dữ liệu Nav -->
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="trangtrai.html">
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
                        <a href="mohinh-ai.html">
                            <i class="bi bi-circle"></i><span>Mô hình AI</span>
                        </a>
                    </li>
                    <li>
                        <a href="huongdan-sudung.html">
                            <i class="bi bi-circle"></i><span>Hướng dẫn sử dụng</span>
                        </a>
                    </li>
                    <li>
                        <a href="video-huongdan.html">
                            <i class="bi bi-circle"></i><span>Video hướng dẫn</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End ứng dụng AI Nav -->
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="lienhe.html">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Liên hệ</span>
                </a>
            </li><!-- End liên hệ Nav -->
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="tintuc.html">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Tin tức</span>
                </a>
            </li><!-- End tin tức Nav -->
    
            <li class="nav-heading">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</li>
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="profile.html">
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
                        <a href="dangtinbenh.php">
                            <i class="bi bi-circle"></i><span>DANG TIN bệnh</span>
                        </a>
                    </li>                    
                </ul>
            </li><!-- End đăng tin Nav -->
    
        </ul>
    
    </aside><!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main" class="main">
    
        <div class="pagetitle">
            <h1>Tin tức</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tin tức</li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    
        <section class="section dashboard">
            <div class="row align-items-top">
                <div class="col-lg-8">
                    <!-- Card with an image on left -->
                    <div class="card mb-3">
                        <div class="card-header">Tin tức nổi bật</div>
                        <div class="row g-0">
                            <?php if ($featured_news): ?>
                                <div class="col-md-4">
                                    <img src="uploads/<?php echo htmlspecialchars($featured_news['image']); ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($featured_news['title']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($featured_news['content']); ?></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <i class="fa-solid fa-clock"></i> <?php echo date("d - m - Y", strtotime($featured_news['post_date'])); ?>
                                </div>
                            <?php else: ?>
                                <p>Không có tin tức nổi bật để hiển thị.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End Card with an image on left -->
    
                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 0;">
                            <!-- Guide Section -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <h3>Tin tức</h3>
                                <div>
                                    <button class="btn btn-primary" id="scroll-left">‹</button>
                                    <button class="btn btn-primary" id="scroll-right">›</button>
                                </div>
                            </div>
    
                            <div class="position-relative">
                                <div id="scrolling-container" class="d-flex flex-nowrap overflow-hidden mb-3">
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="white-spot-disease">Bệnh đốm
                                        trắng (White Spot Disease)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="liver-necrosis">Bệnh hoại tử
                                        gan tụy cấp (AHPND)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="yellow-spot-disease">Bệnh đầu
                                        vàng (Yellow Head Disease)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="ihnv">Bệnh hoại tử cơ quan tạo
                                        máu và cơ quan biểu mô (IHHNV)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="bacterial">Bệnh do vi khuẩn
                                        (Bacterial Diseases)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="parasitic">Bệnh do ký sinh
                                        trùng (Parasitic Diseases)</a>
                                    <a href="#" class="btn btn-outline-primary m-1 flex-shrink-0" data-type="fungal">Bệnh do nấm (Fungal
                                        Diseases)</a>
                                </div>
                            </div>
                            
    
                            <!-- News Cards -->
                            <div id="news-container">
                                <!-- News Cards -->
                                <div id="news-container">
                                    <!-- Hiển thị danh sách tin tức -->
                                    <?php
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $imagePath = 'uploads/' . htmlspecialchars($row["image"]);
                                                $newsLink = htmlspecialchars($row["link"]);
                                                echo '<div class="row mb-3">';
                                                echo '<div class="col-md-4">';
                                                echo '<img src="' . $imagePath . '" class="img-fluid rounded-start" alt="Ảnh tin tức">';
                                                echo '</div>';
                                                echo '<div class="col-md-8">';
                                                echo '<div class="card-body">';
                                                echo '<h5 class="card-title"><a href="' . $newsLink . '" target="_blank">' . htmlspecialchars($row["title"]) . '</a></h5>';
                                                echo '<p class="card-text">' . htmlspecialchars($row["content"]) . '</p>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '<hr>';
                                            }
                                        } else {
                                            echo '<p>Không có tin tức nào để hiển thị.</p>';
                                        }
                                        ?>

                                    </div>

                                    <!-- Centered Pagination -->
                                    <nav aria-label="Page navigation example" style="margin-top: 50px;">
                                        <ul class="pagination justify-content-center" id="pagination">
                                            <!-- Previous Page Link -->
                                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                                            </li>
                                            
                                            <!-- Page Numbers -->
                                            <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
                                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            
                                            <!-- Next Page Link -->
                                            <li class="page-item <?php if ($page >= $number_of_pages) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>

                                <!-- End Centered Pagination -->
                            </div>
                        </div><!-- End Default Card -->
                    </div>
                </div>
    
    
                <div class="col-lg-4">
                    <!-- Giá tôm -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Giá tôm <span>/Hôm nay</span></h5>
    
                            <!-- Line Chart -->
                            <div id="reportsChart"></div>
    
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                            name: 'Tôm nhỏ',
                                            data: [15, 11, 32, 18, 9, 24, 11]
                                        }, {
                                            name: 'Tôm nhỡ',
                                            data: [11, 32, 45, 32, 34, 52, 41]
                                        }, {
                                            name: 'Tôm to',
                                            data: [31, 40, 28, 51, 42, 82, 56]

                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'area',
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.3,
                                                opacityTo: 0.4,
                                                stops: [0, 90, 100]
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            type: 'datetime',
                                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'dd/MM/yy HH:mm'
                                            },
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->
                        </div>
                    </div><!-- End Giá tôm -->
    
                    <!--thời tiết-->
                    <div class="card" style="height: 300px;">
                        <iframe width="100%" height="100%" src="https://thoitiet.app/widget/embed/" id="widgeturl"
                            scrolling="no" frameborder="0" allowtransparency="true" style="border:none; overflow:hidden;">
                        </iframe>
                    </div>
    
                    <!-- News & Updates Traffic -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Bộ lọc</h6>
                                </li>
    
                                <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                                <li><a class="dropdown-item" href="#">Tháng này</a></li>
                                <li><a class="dropdown-item" href="#">Năm này</a></li>
                            </ul>
                        </div>
    
                        <div class="card-body pb-0" style="margin: 10px 0 20px 0">
                            <h5 class="card-title">Tin tức &amp; Cập nhật <span>| Hôm nay</span></h5>
    
                            <div class="news">
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-1.jpg" alt="">
                                    <h4><a href="#">Công nghệ AI phát hiện bệnh tôm</a></h4>
                                    <p>Thông tin tóm gọn về tin tức mới sẽ hiện ở đây...</p>
                                </div>
    
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-2.jpg" alt="">
                                    <h4><a href="#">Công nghệ AI phát hiện bệnh tôm</a></h4>
                                    <p>Thông tin tóm gọn về tin tức mới sẽ hiện ở đây....</p>
                                </div>
    
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-3.jpg" alt="">
                                    <h4><a href="#">Công nghệ AI phát hiện bệnh tôm</a></h4>
                                    <p>Thông tin tóm gọn về tin tức mới sẽ hiện ở đây...</p>
                                </div>
    
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-4.jpg" alt="">
                                    <h4><a href="#">Công nghệ AI phát hiện bệnh tôm</a></h4>
                                    <p>Thông tin tóm gọn về tin tức mới sẽ hiện ở đây...</p>
                                </div>
    
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-5.jpg" alt="">
                                    <h4><a href="#">Công nghệ AI phát hiện bệnh tôm</a></h4>
                                    <p>Thông tin tóm gọn về tin tức mới sẽ hiện ở đây...</p>
                                </div>
    
                            </div><!-- End sidebar recent posts-->
    
                        </div>
                    </div><!-- End News & Updates -->
    
    
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

    <!-- ======= JS ======= -->
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