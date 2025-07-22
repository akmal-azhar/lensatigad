<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID tidak dijumpai.";
    exit;
}

$video_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
$stmt->bind_param("i", $video_id);

if ($stmt->execute()) {
    header("Location: all_videos.php?deleted=true");
    exit;
} else {
    echo "Gagal padam video.";
}
