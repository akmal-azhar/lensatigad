<?php
session_start();
include '../includes/db.php';

// Semak sama ada admin dah login
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    die("Access denied.");
}

// Semak jika ada comment_id dan video_id
if (!isset($_GET['id']) || !isset($_GET['video_id'])) {
    die("Invalid request.");
}

$comment_id = $_GET['id'];
$video_id = $_GET['video_id'];

// Delete komen dari DB
$stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();

// Redirect balik ke video.php
header("Location: ../video.php?id=" . $video_id);
exit;
