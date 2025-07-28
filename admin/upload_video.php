<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $youtube_link = $_POST['youtube_link'];
    $category = $_POST['category'];
    $created_at = date('Y-m-d H:i:s'); // Guna masa sekarang

    // Prepare statement dengan 5 parameter
    $stmt = $conn->prepare("INSERT INTO videos (title, description, youtube_link, category, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $youtube_link, $category, $created_at);

    if ($stmt->execute()) {
        $_SESSION['upload_success'] = "Video berjaya dimuat naik";
    } else {
        $_SESSION['upload_error'] = "Ralat semasa memuat naik video.";
    }

    $stmt->close();
    $conn->close();

    header("Location: dashboard.php");
    exit;
}
?>
