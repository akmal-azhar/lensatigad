<?php
include 'includes/header.php';
include 'includes/db.php';

// Fetch latest videos
$latestVideos = $conn->query("SELECT * FROM videos ORDER BY created_at DESC LIMIT 3");

// Fetch latest articles
$latestArticles = $conn->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lensa TigaD - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .welcome-section {
      background: linear-gradient(to right, #e3f2fd, #bbdefb);
      color: #0d47a1;
      text-align: center;
      padding: 60px 20px;
    }
    .welcome-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .section-heading {
      text-align: center;
      font-weight: 700;
      color: #2c3e50;
      margin: 60px 0 30px;
    }
    .card-title {
      font-weight: 600;
    }
    .card-text {
      color: #555;
    }
    .view-all-btn {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<!-- Welcome Section -->
<section class="welcome-section" data-aos="fade-down">
  <h1>Welcome to Lensa TigaD</h1>
  <p class="mt-3 fs-5">Discover insightful podcasts and articles on Sports, Business, Education & Infotainment.</p>
</section>

<!-- Latest Videos Section -->
<div class="container my-5">
  <h2 class="section-heading" data-aos="fade-up">
    <i class="bi bi-play-circle-fill me-2"></i> Latest Videos
  </h2>
  <div class="row">
    <?php while ($video = $latestVideos->fetch_assoc()): ?>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 shadow-sm">
          <div class="ratio ratio-16x9">
            <iframe src="<?= htmlspecialchars($video['youtube_link']) ?>" title="Video" allowfullscreen></iframe>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($video['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars(substr($video['description'], 0, 100)) ?>...</p>
            <a href="video.php?id=<?= $video['id'] ?>" class="btn btn-sm btn-outline-primary">Watch</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <div class="view-all-btn" data-aos="fade-up">
    <a href="episode.php" class="btn btn-primary btn-sm"><i class="bi bi-collection-play"></i> View All Videos</a>
  </div>
</div>

<!-- Latest Articles Section -->
<div class="container my-5">
  <h2 class="section-heading" data-aos="fade-up">
    <i class="bi bi-file-earmark-text-fill me-2"></i> Latest Articles
  </h2>
  <div class="row">
    <?php while ($article = $latestArticles->fetch_assoc()): ?>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 shadow-sm">
          <img src="uploads/<?= htmlspecialchars($article['thumbnail']) ?>" class="card-img-top" alt="Thumbnail">
          <div class="card-body">
            <h5 class="card-title text-primary"><?= htmlspecialchars($article['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars(substr($article['content'], 0, 120)) ?>...</p>
            <a href="view_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-outline-primary">Read More</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <div class="view-all-btn" data-aos="fade-up">
    <a href="article.php" class="btn btn-primary btn-sm"><i class="bi bi-journal-text"></i> View All Articles</a>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true,
  });
</script>
</body>
</html>
