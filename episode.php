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

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      background-color: #f2f6fc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .episode-container {
      padding: 60px 20px;
      background: #fff;
    }

    .episode-container h2 {
      font-size: 32px;
      font-weight: bold;
      color: #4a69bd;
      text-align: center;
      margin-bottom: 40px;
    }

    .episode-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .episode-card {
      background: #ffffff;
      border: 1px solid #e1e8f2;
      border-radius: 15px;
      padding: 20px;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .episode-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .episode-card iframe {
      width: 100%;
      height: 180px;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .episode-card h4 a {
      text-decoration: none;
      font-size: 18px;
      font-weight: 600;
      color: #34495e;
      transition: color 0.2s ease;
    }

    .episode-card h4 a:hover {
      color: #4a69bd;
    }

    .episode-card p {
      font-size: 14px;
      color: #6c757d;
    }
  </style>
</head>

<body>
  <div class="container episode-container">
    <h2><i class="bi bi-play-btn-fill"></i> Semua Episod Podcast</h2>

    <div class="episode-grid">
      <?php $i = 0; ?>
      <?php while ($video = $allVideos->fetch_assoc()): ?>
        <div class="episode-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
          <iframe src="<?= htmlspecialchars($video['youtube_link']) ?>" frameborder="0" allowfullscreen></iframe>
          <h4><a href="video.php?id=<?= $video['id'] ?>"><?= htmlspecialchars($video['title']) ?></a></h4>
          <p><?= htmlspecialchars($video['description']) ?></p>
        </div>
        <?php $i++; ?>
      <?php endwhile; ?>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      once: true
    });
  </script>
</body>
</html>
