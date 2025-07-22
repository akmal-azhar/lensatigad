<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $youtube_link = $_POST['youtube_link'];

    $stmt = $conn->prepare("INSERT INTO videos (title, description, youtube_link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $youtube_link);

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
