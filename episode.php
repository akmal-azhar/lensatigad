<?php
session_start();
require 'includes/db.php';
$allVideos = $conn->query("SELECT * FROM videos ORDER BY created_at DESC");
?>

<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Semua Episod - Lensa TigaD</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .episode-container {
      padding: 40px 20px;
      background: #fff;
      text-align: center;
    }

    .episode-container h2 {
      font-size: 28px;
      margin-bottom: 30px;
      color: #333;
    }

    .episode-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      padding: 0 10px;
    }

    .episode-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .episode-card:hover {
      transform: translateY(-5px);
    }

    .episode-card iframe {
      width: 100%;
      height: 180px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .episode-card h4 {
      font-size: 18px;
      margin: 10px 0 8px;
      color: #222;
    }

    .episode-card a {
      text-decoration: none;
      color: #333;
    }

    .episode-card a:hover {
      text-decoration: underline;
    }

    .episode-card p {
      font-size: 14px;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="episode-container">
    <h2>📺 All Episode Podcast</h2>

    <div class="episode-grid">
      <?php while ($video = $allVideos->fetch_assoc()): ?>
        <div class="episode-card">
          <iframe src="<?= htmlspecialchars($video['youtube_link']) ?>" frameborder="0" allowfullscreen></iframe>
          <h4><a href="video.php?id=<?= $video['id'] ?>"><?= htmlspecialchars($video['title']) ?></a></h4>
          <p><?= htmlspecialchars($video['description']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
