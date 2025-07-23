<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: all_videos.php?message=Video telah dibuang");
    } else {
        header("Location: all_videos.php?message=Gagal padam video");
    }
} else {
    header("Location: all_videos.php?message=Permintaan tidak sah");
}
exit;
?>
