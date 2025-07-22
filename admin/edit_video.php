<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID video tidak sah.";
    exit;
}

$video_id = $_GET['id'];

// Proses kemaskini
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $youtube_link = $_POST['youtube_link'];

    $stmt = $conn->prepare("UPDATE videos SET title = ?, description = ?, youtube_link = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $youtube_link, $video_id);

    if ($stmt->execute()) {
        header("Location: all_videos.php?updated=true");
        exit;
    } else {
        echo "Ralat semasa mengemaskini video.";
    }
}

// Dapatkan data sedia ada
$stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$result = $stmt->get_result();
$video = $result->fetch_assoc();

if (!$video) {
    echo "Video tidak dijumpai.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Video</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3>Edit Video</h3>
  <form method="post">
    <div class="mb-3">
      <label for="title" class="form-label">Tajuk</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($video['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($video['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="youtube_link" class="form-label">YouTube Embed Link</label>
      <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="<?= htmlspecialchars($video['youtube_link']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Kemaskini</button>
    <a href="all_videos.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>
