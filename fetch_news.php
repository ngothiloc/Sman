<?php
// Kết nối đến database
include 'db.php';

// Get the disease type from the request
$disease_type = isset($_GET['disease_type']) ? $_GET['disease_type'] : '';

// Define the number of results per page
$results_per_page = 4; 

// Find out the number of results stored in the database
$sql = "SELECT * FROM news WHERE disease_type = '$disease_type' ORDER BY id DESC";
$result = $conn->query($sql);
$number_of_results = $result->num_rows;

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Ensure page is not less than 1
if ($page > $number_of_pages) $page = $number_of_pages; // Ensure page is not more than total pages

// Determine the SQL LIMIT starting number for the results on the displaying page
$start_limit = ($page - 1) * $results_per_page;

// Retrieve the selected results from the database
$sql = "SELECT * FROM news WHERE disease_type = '$disease_type' ORDER BY id DESC LIMIT " . $start_limit . ', ' . $results_per_page;
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePath = 'uploads/' . htmlspecialchars($row["image"]);
        $newsLink = htmlspecialchars($row["link"]);
        echo '<div class="card mb-3">';
        echo '<div class="row g-0">';
        echo '<div class="col-md-4">';
        echo '<img src="' . $imagePath . '" class="img-fluid rounded-start" alt="...">';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><a href="' . $newsLink . '" target="_blank">' . htmlspecialchars($row["title"]) . '</a></h5>';
        echo '<p class="card-text">' . htmlspecialchars($row["content"]) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<i class="fa-solid fa-clock"></i> ' . $row["post_date"];
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Không có tin tức nào để hiển thị.</p>';
}

$conn->close();
?>
