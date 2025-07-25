<?php
session_start();
require 'includes/db.php';

// Ambil 3 video lain selepas yang latest tadi
$allVideos = $conn->query("SELECT * FROM videos ORDER BY created_at DESC LIMIT 3");
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lensa TigaD - Home</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      line-height: 1.6;
      background-color: #ffffff;
      color: #111;
    }

    .hero {
      background: linear-gradient(to right, #e3f2fd, #bbdefb);
      color: #0d47a1;
      padding: 100px 20px;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      min-height: 300px;
    }

    .banner {
      background-color: #f1f9ff;
      padding: 40px 20px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .banner div {
      background: #ffffff;
      color: #111;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 280px;
      text-align: center;
    }

    .intro {
      padding: 60px 20px;
      text-align: center;
      background: #e3f2fd;
      color: #111;
    }

    .video-section {
      padding: 50px 20px;
      background: #ffffff;
    }

    .video-box {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 20px;
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08);
      margin-bottom: 25px;
    }

    .video-box iframe {
      width: 300px;
      height: 170px;
      border-radius: 8px;
      border: none;
    }

    .video-box .description h4 a {
      color: #0d6efd;
      text-decoration: none;
    }

    .video-box .description h4 a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .banner {
        flex-direction: column;
        align-items: center;
      }

      .video-box {
        flex-direction: column;
        text-align: center;
      }

      .video-box iframe {
        width: 100%;
        height: 200px;
      }
    }
  </style>
</head>
<body>

  <!-- HERO -->
  <div class="hero" data-aos="fade-left">
    <div class="hero-text">
      <h1 class="display-5 fw-bold">Welcome to Lensa TigaD 🎥</h1>
      <p class="lead">Your trusted platform for Sports, Business, Education, and Infotainment — discover knowledge, ideas, and experience it all in one place.</p>
    </div>
  </div>

  <!-- BANNER SECTION -->
  <div class="banner">
    <div data-aos="fade-up" data-aos-delay="100">
      <h4 class="text-primary fw-semibold">Sports</h4>
      <p>Engaging local & global sports highlights, analysis, and updates for all fans.</p>
    </div>
    <div data-aos="fade-up" data-aos-delay="200">
      <h4 class="text-primary fw-semibold">Business</h4>
      <p>Market trends, financial tips, and expert insights to sharpen your entrepreneurial mind.</p>
    </div>
    <div data-aos="fade-up" data-aos-delay="300">
      <h4 class="text-primary fw-semibold">Education</h4>
      <p>Educational content across various fields to boost your knowledge and growth.</p>
    </div>
    <div data-aos="fade-up" data-aos-delay="400">
      <h4 class="text-primary fw-semibold">Infotainment</h4>
      <p>Fun and informative shows, podcasts, and more to keep you connected & entertained.</p>
    </div>
  </div>

  <!-- INTRO -->
  <div class="intro" data-aos="fade-up">
    <h2 class="fw-bold text-primary">What is Lensa TigaD?</h2>
    <p class="mt-3">Lensa TigaD is a platform where videos and podcast episodes from various topics are showcased. Join our growing community and explore informative, inspiring, and entertaining content made just for you.</p>
  </div>

  <!-- LATEST VIDEOS -->
  <div class="video-section container">
    <h2 class="mb-4 text-center fw-bold text-primary" data-aos="fade-up">🎬 3 Latest Videos</h2>
    <?php while ($video = $allVideos->fetch_assoc()): ?>
      <div class="video-box" data-aos="fade-up">
        <iframe src="<?= htmlspecialchars($video['youtube_link']) ?>" allowfullscreen></iframe>
        <div class="description">
          <h4><a href="video.php?id=<?= $video['id'] ?>"><?= htmlspecialchars($video['title']) ?></a></h4>
          <p><?= htmlspecialchars($video['description']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <?php include 'includes/footer.php'; ?>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: false
    });
  </script>
</body>
</html>
