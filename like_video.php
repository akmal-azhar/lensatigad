<?php
session_start();
header('Content-Type: application/json');
include 'includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'client') {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user']['id'];
$video_id = $_POST['video_id'];
$type = $_POST['type']; // 'like' atau 'dislike'

// Toggle like/dislike
$check = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND video_id = ? AND type = ?");
$check->bind_param("iis", $user_id, $video_id, $type);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Sudah ada - remove (unlike/undislike)
    $delete = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND video_id = ? AND type = ?");
    $delete->bind_param("iis", $user_id, $video_id, $type);
    $delete->execute();
} else {
    // Delete opposite (kalau like, buang dislike)
    $opposite = $type === 'like' ? 'dislike' : 'like';
    $remove = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND video_id = ? AND type = ?");
    $remove->bind_param("iis", $user_id, $video_id, $opposite);
    $remove->execute();

    // Tambah like/dislike
    $insert = $conn->prepare("INSERT INTO likes (user_id, video_id, type, created_at) VALUES (?, ?, ?, NOW())");
    $insert->bind_param("iis", $user_id, $video_id, $type);
    $insert->execute();
}

// Kira jumlah terkini
$countLikes = $conn->prepare("SELECT COUNT(*) FROM likes WHERE video_id = ? AND type = 'like'");
$countLikes->bind_param("i", $video_id);
$countLikes->execute();
$countLikes->bind_result($like_count);
$countLikes->fetch();
$countLikes->close();

$countDislikes = $conn->prepare("SELECT COUNT(*) FROM likes WHERE video_id = ? AND type = 'dislike'");
$countDislikes->bind_param("i", $video_id);
$countDislikes->execute();
$countDislikes->bind_result($dislike_count);
$countDislikes->fetch();
$countDislikes->close();

// Semak state semasa user
$liked = false;
$disliked = false;

$state = $conn->prepare("SELECT type FROM likes WHERE user_id = ? AND video_id = ?");
$state->bind_param("ii", $user_id, $video_id);
$state->execute();
$res = $state->get_result();
while ($row = $res->fetch_assoc()) {
    if ($row['type'] === 'like') $liked = true;
    if ($row['type'] === 'dislike') $disliked = true;
}

echo json_encode([
    'like_count' => $like_count,
    'dislike_count' => $dislike_count,
    'liked' => $liked,
    'disliked' => $disliked
]);
