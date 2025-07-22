<?php
session_start();
include 'includes/db.php';

// Semak sama ada user client
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'client') {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = trim($_POST['comment']);
    $video_id = $_POST['video_id'];
    $user_id = $_SESSION['user']['id'];

    if (empty($comment)) {
        echo "Komen tidak boleh kosong.";
        exit;
    }

    // Masukkan ke table komen
    $stmt = $conn->prepare("INSERT INTO comments (video_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $video_id, $user_id, $comment);

    if ($stmt->execute()) {
        // Redirect balik ke video page
        header("Location: video.php?id=" . $video_id);
        exit;
    } else {
        echo "SQL Error: " . $stmt->error;
        exit;
    }
}
